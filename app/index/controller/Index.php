<?php

namespace app\index\controller;

use app\common\controller\Blogbase;
use think\facade\View;

class Index extends Blogbase {

	public function index() {
		$type = input('get.type/d', 0);
		$pageSize = 5; //每页显示5条数据 可自行修改
		$mod = new \app\admin\model\Article();
		$where[] = ['status', '=', 1];
		$paginate_query = [];
		if ($type) {
			$where[] = ['type', '=', $type];
			$map[] = ['type', '=', $type];
			$paginate_query = ['type' => $type]; // 分页url参数
		}
		$list = $mod->where($where)->paginate($pageSize, false, [
			'query' => $paginate_query
		]);
		if (empty($list)) {
			return $this->jump404();
		}
		//      顶部轮播图 start
		$map[] = ['status', '=', 1];
		$map[] = ['img', '<>', ''];
		$tops = $mod->where($map)->orderRaw('id desc')->limit(5)->column('id,title,img', 'id');
		//      顶部轮播图 end
		// 获取分页显示
		$page = $list->render();
		View::assign([
			'list' => $list,
			'type' => $type,
			'tops' => $tops,
			'page' => $page,
		]);
		return $this->blogTpl();
	}

}
