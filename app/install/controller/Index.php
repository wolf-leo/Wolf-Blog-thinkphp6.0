<?php

namespace app\install\controller;

use app\InstallBaseController;
use think\facade\View;

class Index extends InstallBaseController {

	public function __construct() {
		parent::__construct();
		define('ROOT_PATH', public_path());
		$installlocak_file = ROOT_PATH . 'wcore' . DIRECTORY_SEPARATOR . 'install.lock';
		if (file_exists($installlocak_file)) {
			header('Location:/');
			exit;
		}
	}

	public function index() {
		return $this->installTpl();
	}

	public function step2() {
		$err = 0;
		$phpversion = $mysql = $uploadSize = $session = $curl = '';
		if (version_compare(PHP_VERSION, '7.1.0', '<')) {
			$phpversion = correct_span(PHP_VERSION, 0);
			$err++;
		} else {
			$phpversion = correct_span(PHP_VERSION, 1);
		}
		if (class_exists('pdo')) {
			$mysql = correct_span("已安装PDO扩展", 1);
		} else {
			//如果没有安装PDO扩展，在检查是否安装MYSQLI扩展
			if (class_exists('mysqli')) {
				$mysql = correct_span("已安装MYSQLI扩展", 1);
			} else {
				$mysql = correct_span("未安装PDO和MYSQLI", 0);
				$err++;
			}
		}
		if (ini_get('file_uploads')) {
			$uploadSize = correct_span(ini_get('upload_max_filesize'), 1);
		} else {
			$uploadSize = correct_span("禁止上传", 0);
		}
		if (function_exists('session_start')) {
			$session = correct_span("支持", 1);
		} else {
			$session = correct_span("不支持", 0);
			$err++;
		}
		if (function_exists('curl_init')) {
			$curl = correct_span("支持", 1);
		} else {
			$curl = correct_span("不支持", 0);
			$err++;
		}

		$folder = ['runtime', 'wcore', 'public/uploads'];
		foreach ($folder as $key => $dir) {
			$testdir = ROOT_PATH . $dir;
			if (testwrite($testdir)) {
				$w = correct_span("可写", 1);
			} else {
				$w = correct_span("不可写", 0);
				$err++;
			}
			if (is_readable($testdir)) {
				$r = correct_span("可读", 1);
			} else {
				$r = correct_span("不可读", 0);
				$err++;
			}
		}
		View::assign([
			'phpversion' => $phpversion,
			'mysql' => $mysql,
			'uploadSize' => $uploadSize,
			'session' => $session,
			'curl' => $curl,
			'folder' => $folder,
			'err' => $err,
		]);
		return $this->installTpl();
	}

	public function step3() {
		$domain = request()->domain();
		View::assign([
			'domain' => $domain,
			'webPath' => ROOT_PATH,
		]);
		@touch(ROOT_PATH . 'wcore' . DIRECTORY_SEPARATOR . 'step2_successed.lock');
		return $this->installTpl();
	}

	public function step4() {
		if (!request()->isPost()) {
			$url = url('/index/index')->build();
			header('Location: ' . $url);
			exit;
		}
		$check = request()->checkToken('__token__');
		if (false === $check) {
			$url = url('/index/step3')->build();
			header('Location: ' . $url);
			exit;
		}
		View::assign(['post' => input('post.'),]);
		@touch(ROOT_PATH . 'wcore' . DIRECTORY_SEPARATOR . 'step3_successed.lock');
		return $this->installTpl();
	}

	public function step5() {
		if (file_exists(ROOT_PATH . 'wcore' . DIRECTORY_SEPARATOR . 'step4_successed.lock')) {
			@touch(ROOT_PATH . 'wcore' . DIRECTORY_SEPARATOR . 'install.lock');
		}
		return $this->installTpl();
	}

	public function installDb() {
		$n = input('get.n/d', 0);
		$error = ['code' => 0, 'msg' => 'error', 'n' => $n];
		$success = ['code' => 1, 'msg' => 'success', 'n' => $n];
		if (!request()->isAjax()) {
			return json($error);
		}
		$dbType = input('post.dbtype/s', 'pdo', 'trim');
		$dbHost = input('post.dbhost/s', '', 'trim');
		$dbPort = input('post.dbport/d', '', 'trim');
		$dbName = input('post.dbname/s', 'wolfcode_blog', 'trim');
		$dbUser = input('post.dbuser/s', '', 'trim');
		$dbPwd = input('post.dbpw/s', '', 'trim');
		$dbPrefix = input('post.dbprefix/s', '', 'trim');
		$dbCahrset = input('post.dbcharset/s', 'utf8', 'trim');
		$adminname = input('post.manager_adminname/s', '', 'trim');
		$password = input('post.manager_pwd/s', '', 'trim');
		$config = $arr = [];
		$config['db_type'] = in_array($dbType, ['pdo', 'mysqli', 'mysql']) ? $dbType : 'pdo';
		$config['db_host'] = $dbHost;
		$config['db_name'] = $dbName;
		$config['db_user'] = $dbUser;
		$config['db_pwd'] = $dbPwd;
		$config['db_port'] = $dbPort;
		$config['db_prefix'] = $dbPrefix;
		try {
			$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, null, $dbPort);
		} catch (\Exception $e) {
			$error['msg'] = correct_span("连接 MySQL 失败: " . mysqli_connect_error() . ' 请刷新本页面后检查数据库账号密码', 0);
			return json($error);
		}
		$mysql_version = (string) mysqli_get_server_info($conn);
		$exp_mysql = explode('.', $mysql_version);
		if (count($exp_mysql) < 3) {
			array_push($exp_mysql, '0');
		}
		list($m, $s, $q) = $exp_mysql;
		if ($m < 5) {
			$error['msg'] = correct_span("MySQL 版本太低，当前版本 {$mysql_version} ，需要最低 5+", 0);
			mysqli_close($conn);
			return json($error);
		}
		// MySQL 小于 5.5.3 不支持 utf8mb4
		if ($m == 5) {
			if ($s < 5) {
				if ($dbCahrset == 'utf8mb4') {
					$error['msg'] = correct_span("MySQL 版本太低，当前版本 {$mysql_version} ，utf8mb4 编码最低要求版本 5.5.3+", 0);
					mysqli_close($conn);
					return json($error);
				}
			}
			if ($s == 5 && $q < 3) {
				if ($dbCahrset == 'utf8mb4') {
					$error['msg'] = correct_span("MySQL 版本太低，当前版本 {$mysql_version} ，utf8mb4 编码最低要求版本 5.5.3+", 0);
					mysqli_close($conn);
					return json($error);
				}
			}
		}
		mysqli_query($conn, "SET NAMES {$dbCahrset}");
		if (!mysqli_select_db($conn, $dbName)) {
			if (!mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `{$dbName}` DEFAULT CHARACTER SET {$dbCahrset};")) {
				$error['msg'] = correct_span("数据库{$dbName} 不存在，也没权限创建新的数据库！", 0);
				mysqli_close($conn);
				return json($error);
			}
			if (!$n) {
				$success['n'] = 1;
				$success['msg'] = '<li>' . correct_span("成功创建数据库 {$dbName}", 1) . '</li> ';
				mysqli_close($conn);
				return json($success);
			}
			mysqli_select_db($conn, $dbName);
		}
		//读取数据文件
		$dbbase_file = ROOT_PATH . 'extend' . DIRECTORY_SEPARATOR . 'database.sql';
		if (file_exists($dbbase_file) === false) {
			$error['msg'] = correct_span("数据库基础获取异常，请确认{$dbbase_file}文件是否存在", 0);
			mysqli_close($conn);
			return json($error);
		}
		$sqldata = file_get_contents($dbbase_file);
		$sqlFormat = sql_split($sqldata, $dbPrefix);
		$counts = count($sqlFormat);
		$message = '';
		for ($i = $n; $i < $counts; $i++) {
			$sql = trim($sqlFormat[$i]);
			if (strstr($sql, 'CREATE TABLE')) {
				preg_match('/CREATE TABLE `([^ ]*)`/', $sql, $matches);
				//mysqli_query($conn, "DROP TABLE IF EXISTS `$matches[1]");
				$ret = mysqli_query($conn, $sql);
				$db_title = $matches[1] ?? "";
				if ($ret) {
					$message .= '<li>' . correct_span("创建数据表 {$db_title} 完成", 1) . '</li> ';
				} else {
					$message .= '<li>' . correct_span("创建数据表 {$db_title} 失败，请检查该数据表是否已经存在", 0) . '</li> ';
				}
				$i++;
				$success['msg'] = $message;
				$success['n'] = $i;
				return json($success);
			}
		}
		if ($i < 1) {
			$message = '创建数据表失败';
			$error['msg'] = $message;
			$error['n'] = 0;
			mysqli_close($conn);
			return json($error);
		}
		if ($i == 999999) {
			$success['n'] = $i;
			mysqli_close($conn);
			return json($success);
		}
		//插入管理员
		$md5_password = AdminPassword($password);
		$time = time();
		$query = "INSERT INTO `{$dbPrefix}admin` VALUES ('1', '{$adminname}', '{$md5_password}', '1', '超级管理员', '', '', '', '0', '', '{$time}', '系统',1)";
		$ret = mysqli_query($conn, $query);

		$sql_data = ROOT_PATH . 'extend' . DIRECTORY_SEPARATOR . 'sqldata.sql';
		if (file_exists($sql_data)) {
			$sql2 = file_get_contents($sql_data);
			if (!mysqli_select_db($conn, $dbName)) {
				$message = "数据库{$dbName}不存在！";
				$error['msg'] = $message;
				$error['n'] = 0;
				mysqli_close($conn);
				return json($error);
			}
			$exp = array_filter(explode('INSERT INTO', ($sql2)));
			$count = count($exp) + 1;
			$value = '';
			$result2 = FALSE;
			foreach ($exp as $key => $value) {
				$query_sql = 'INSERT INTO ' . htmlspecialchars_decode($value);
				$result2 = mysqli_query($conn, $query_sql);
			}
		}
		mysqli_close($conn);
		if ($ret) {
			$message = correct_span('添加后台管理员成功', 1);
			$success['msg'] = $message;
			$success['n'] = 999999;
			@touch(ROOT_PATH . 'wcore' . DIRECTORY_SEPARATOR . 'step4_successed.lock');
			return json($success);
		} else {
			$message = correct_span('添加后台管理员失败', 0);
			$error['msg'] = $message;
			$error['n'] = 0;
			return json($error);
		}
	}

	/**
	 * 检测Db数据库连接
	 * @return json
	 */
	public function checkdb() {
		$error = ['code' => 0];
		$success = ['code' => 1];
		if (!request()->isAjax() || !request()->isPost()) {
			return json($error);
		}
		$dbhost = input('post.dbhost/s', '');
		$dbuser = input('post.dbuser/s', '');
		$dbpw = input('post.dbpw/s', '');
		$dbport = input('post.dbport/d', 0);
		$conn = mysqli_connect($dbhost, $dbuser, $dbpw, null, $dbport);
		if (!$conn) {
			return json($error);
		}
		return json($success);
	}

}
