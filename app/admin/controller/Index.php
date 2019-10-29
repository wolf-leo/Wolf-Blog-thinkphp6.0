<?php

namespace app\admin\controller;

use app\AdminBaseController;
use think\facade\View;

class Index extends AdminBaseController {

	public function index() {
		return $this->adminPublicTpl();
	}

	public function main() {
		return $this->adminTpl();
	}

}
