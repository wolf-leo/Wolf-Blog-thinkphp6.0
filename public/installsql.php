<?php

/*
 * 数据库安装程序
 * 
 * 请先确认好/config/database.php的数据库连接配置
 *
 *  version = '1.1';
 */
// header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('PRC');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@set_time_limit(1000);
$root_path = dirname(__FILE__);
//获取数据库配置
require_once __DIR__ . '/../vendor/autoload.php';
$database = include_once dirname($root_path) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';
if (!isset($database) || !is_array($database) || empty($database)) {
	exit('请先确认好/config/database.php的数据库连接配置！');
}
$lock_file = dirname($root_path) . DIRECTORY_SEPARATOR . 'extend' . DIRECTORY_SEPARATOR . 'installsql.lock';
if (file_exists($lock_file)) {
	header("Location:/");
	return TRUE;
}
$sql_base = dirname($root_path) . DIRECTORY_SEPARATOR . 'extend' . DIRECTORY_SEPARATOR . 'myblog.sql';
$sql_data = dirname($root_path) . DIRECTORY_SEPARATOR . 'extend' . DIRECTORY_SEPARATOR . 'sqldata.sql';
if (!file_exists($sql_base) && !file_exists($sql_data)) {
	exit('缺少必要的数据库安装文件，如果希望自己创建数据库，请将index.php中的INSTALL_SQL值修改成FALSE!');
}
$arr = [];
$dbHost = $database['hostname'];
$dbPort = $database['hostport'];
$dbName = $database['database'];
$dbUser = $database['username'];
$dbPwd = $database['password'];
$dbPrefix = $database['prefix'];
$dbCharset = $database['charset'];
$conn = mysqli_connect($dbHost, $dbUser, $dbPwd);
if (!$conn) {
	exit("连接数据库失败！");
}
mysqli_query($conn, "SET NAMES '{$dbCharset}'");
$version = mysqli_get_server_info($conn);
$version_exp = explode('.', $version);
if (count($version_exp) < 1) {
	exit("获取数据库版本号失败！");
}
if ($version_exp[0] < 4) {
	exit("数据库版本太低！");
}

if (!mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `" . $dbName . "` DEFAULT CHARSET {$dbCharset} ;")) {
	exit("数据库{$dbName}不存在，也没权限创建新的数据库！");
}

//读取数据文件
$sql1 = file_get_contents($sql_base);
$sql2 = file_get_contents($sql_data);
if (!mysqli_select_db($conn, $dbName)) {
	exit("数据库{$dbName}不存在！");
}
$tables = mysqli_fetch_row(mysqli_query($conn, "SHOW TABLES"));
if (is_array($tables)) {
	if (in_array('article', $tables)) {
		@touch($lock_file);
		header("Location:/");
		return TRUE;
	}
}

$result1 = FALSE;
$exp_sql1 = explode(";\n", trim($sql1));
if (count($exp_sql1) < 3) { // 兼容回车
	$exp_sql1 = explode(";" . PHP_EOL, trim($sql1));
}
foreach ($exp_sql1 as $query) {
	$result1 = mysqli_query($conn, $query);
}
if (!$result1) {
	exit("添加数据表失败！");
}
$exp = array_filter(explode('INSERT INTO', ($sql2)));

$count = count($exp) + 1;
$value = '';
$result2 = FALSE;
foreach ($exp as $key => $value) {
	$query_sql = 'INSERT INTO ' . htmlspecialchars_decode($value);
	$result2 = mysqli_query($conn, $query_sql);
}
if (!$result2) {
	exit("新增数据表数据失败！");
}
mysqli_close($conn);
if ($result2) {
	@touch($lock_file);
	header("Location:/");
	return TRUE;
}
