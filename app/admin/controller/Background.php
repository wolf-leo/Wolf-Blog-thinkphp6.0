<?php

namespace app\admin\controller;

use app\common\controller\Adminbase;
use think\facade\View;

class Background extends Adminbase {

	protected $mod;

	public function __construct() {
		parent::__construct();
		$this->mod = new \app\admin\model\Background();
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

	/**
	 * Windows 环境下如果遇到
	 * upload_tmp_dir 临时文件夹问题
	 * 上传文件提示
	 * Warning: File upload error - unable to create a temporary file in Unknown on line 0
	 * 找到php.ini 中的 upload_tmp_dir 把前边的“；”去掉然后改为upload_tmp_dir =C:\Windows\temp
	 * 最后记得重启apache
	 */
	public function edit() {
		$id = input('id');
		$info = $this->mod->find($id);
		if (IS_POST) { //数据操作
			$data = input('post.');
			unset($data['id']);
			$file = $file2 = '';
			if (!empty($_FILES['head_back_img']['tmp_name'])) {
				$file = request()->file('head_back_img'); //图片上传  
			}
			if (!empty($_FILES['main_back_img']['tmp_name'])) {
				$file2 = request()->file('main_back_img'); //图片上传
			}
			if ($file) {
				$file_path = \think\facade\App::getRootPath() . 'public' . DIRECTORY_SEPARATOR . 'uploads';
				$img_path = DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
				$img_info = $file->move($file_path);
				if ($img_info) {
					$data['head_back_img'] = $img_path . $img_info->getSaveName();
				}
			}
			if ($file2) {
				$file_path2 = \think\facade\App::getRootPath() . 'public' . DIRECTORY_SEPARATOR . 'uploads';
				$img_path2 = DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
				$img_info2 = $file2->move($file_path2);
				if ($img_info2) {
					$data['main_back_img'] = $img_path2 . $img_info2->getSaveName();
				}
			}
			if ($id) { //更新数据
				$where['id'] = $id;
				$x = $this->mod->where($where)->update($data);
			} else { //添加数据
				$data['c_time'] = date('Y-m-d H:i:s');
				$x = $this->mod->insertGetId($data);
			}
			$x and success('修改成功') or error('修改失败');
		} else {
			View::assign([
				'info' => $info,
			]);
			return $this->adminTpl();
		}
	}

}
