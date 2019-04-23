<?php

namespace app\admin\controller;

use app\common\controller\Adminbase;

class Index extends Adminbase {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		return $this->adminTpl();
	}

}
