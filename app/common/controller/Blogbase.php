<?php

namespace app\common\controller;

use app\common\controller\Base;
use think\facade\View;

class Blogbase extends Base {

	public function __construct() {
		parent::__construct();
		$this->blogHeadNav();
	}

	//获取博客头部分类
	protected function blogHeadNav() {
		$category = new \app\admin\model\Category();
		$background = new \app\admin\model\Background();
		$headernav = $category->where(['status' => 1])->order('sort desc')->column('title', 'id');
		$backimg = $background->find(1);
		View::assign(['headernav' => $headernav, 'backimg' => $backimg]);
	}

	public function jump404() {
		//只有在app_debug=False时才会正常显示404页面，否则会有相应的错误警告提示
		abort(404, '页面异常');
	}

	public function blogTpl() {
		//直接引入头部和底部文件，在新建页面模版的时候省去重复引入的环节
		$contrroller = strtolower(CONTROLLER_NAME);
		$action = strtolower(ACTION_NAME);
		return View::fetch('public_head') . View::fetch($contrroller . '_' . $action) . View::fetch('public_foot');
	}

	//空方法
	public function _empty() {
		return $this->jump404();
	}

}
