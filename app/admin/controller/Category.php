<?php

namespace app\admin\controller;

use app\common\controller\Adminbase;
use think\facade\View;

class Category extends Adminbase {

	protected $mod;

	public function __construct() {
		parent::__construct();
		$this->mod = new \app\admin\model\Category();
		View::assign([
			'notes' => $this->mod->notes,
		]);
	}

	public function index() {
		$pageSize = 5; //每页显示的数量
		$where = [];
		if (input('id')) {
			$where[] = ['id', '=', input('id')];
		}
		$list = $this->mod->where($where)->orderRaw('id desc')->paginate($pageSize, false, []);
		View::assign([
			'list' => $list,
		]);
		return $this->adminTpl();
	}

	public function edit() {
		$id = input('id/d', 0);
		$info = $this->mod->where('id', $id)->find();
		if (IS_POST) { //数据操作
			$data = input('post.');
			unset($data['id']);
			if ($id) { //更新数据
				$where['id'] = $id;
				$x = $this->mod->where($where)->update($data);
			} else { //添加数据
				$data['c_time'] = date('Y-m-d H:i:s');
				$x = $this->mod->insertGetId($data);
			}
			$x and $this->jump(1, '修改成功') or $this->jump(0, '修改失败');
		} else {
			View::assign([
				'info' => $info,
			]);
			return $this->adminTpl();
		}
	}

}
