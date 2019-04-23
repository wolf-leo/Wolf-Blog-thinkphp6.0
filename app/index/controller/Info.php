<?php

namespace app\index\controller;

use app\common\controller\Blogbase;
use think\facade\View;

class Info extends Blogbase {

	protected $mod;

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$id = input('id/d', 0);
		if (!$id) {
			return $this->jump404();
		}
		$mod = new \app\admin\model\Article();
		$info = $mod->find($id);
		if (!$info) {
			return $this->jump404();
		}
		View::assign([
			'info' => $info,
			'type' => $info['type'],
			'title' => $info['title'],
		]);
		return $this->blogTpl();
	}

}
