<?php

declare (strict_types=1);

namespace app;

use think\facade\View;

/**
 * 控制器基础类
 */
class InstallBaseController {

	public function __construct() {
		// 控制器初始化
		$this->initialize();
	}

	// 初始化
	protected function initialize() {
		$version = \think\App::VERSION;
		$powered = "WolfCode-内容管理系统[ThinkPHP{$version}]";
		View::assign([
			'version' => '1.0',
			'powered' => $powered,
			'default_dbname' => 'wolfcode_blog',
			'wolfcode_url' => 'https://www.wolfcode.com.cn',
		]);
	}

	public function jump404() {
		//只有在app_debug=False时才会正常显示404页面，否则会有相应的错误警告提示
		abort(404, '页面异常');
	}

	public function installTpl() {
		//直接引入头部和底部文件，在新建页面模版的时候省去重复引入的环节
		$contrroller = strtolower(request()->controller());
		$action = strtolower(request()->action());
		return View::fetch('public/head') . View::fetch() . View::fetch('public/foot');
	}

	//空方法
	public function _empty() {
		return $this->jump404();
	}

}
