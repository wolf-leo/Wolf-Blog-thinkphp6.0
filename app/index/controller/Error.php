<?php

namespace app\index\controller;

use app\common\controller\Blogbase;

class Error extends Blogbase {

	public function index() {
		return $this->jump404();
	}

	public function _empty() {
		return $this->jump404();
	}

}
