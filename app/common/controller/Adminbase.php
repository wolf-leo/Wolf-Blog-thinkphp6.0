<?php

namespace app\common\controller;

use app\common\controller\Base;
use think\facade\View;

class Adminbase extends Base {

	public function __construct($checkLogin = True) {
		parent::__construct();
		if ($checkLogin) {
			$this->isLogin();
		}
		$controller = strtolower(CONTROLLER_NAME);
		$action = strtolower(ACTION_NAME);
		$tempname = '/' . $controller . '/' . $action;
		View::assign([
			'controller' => $controller,
			'action' => $action,
			'tempname' => $tempname,
		]);
	}

	protected function isLogin() {
		$admin_uid = session('admin_uid');
		if (empty($admin_uid)) {
			$url = url('Login/index');
			return redirect($url);
			exit;
		}
	}

	public function jump404() {
		//只有在app_debug=False时才会正常显示404页面，否则会有相应的错误警告提示
		abort(404, '页面异常');
	}

	public function adminTpl() {
		//直接引入头部和底部文件，在新建页面模版的时候省去重复引入的环节
		$contrroller = strtolower(CONTROLLER_NAME);
		$action = strtolower(ACTION_NAME);
		return View::fetch('\public_head') . View::fetch('\\' . $contrroller . '_' . $action) . View::fetch('\public_foot');
	}

	//空方法
	public function _empty() {
		return $this->jump404();
	}

}
