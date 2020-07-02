<?php

namespace app\index\controller;

use app\BlogBaseController;
use think\facade\View;

class Index extends BlogBaseController
{

    public function index() {
        $type = input('type/d', 0);
        $pageSize = 5; //每页显示5条数据 可自行修改
        $mod = new \app\admin\model\Article;
        $where[] = ['status', '=', 1];
        if ($type) {
            $where[] = ['type', '=', $type];
            $map[] = ['type', '=', $type];
        }
        $list = $mod->where($where)->orderRaw('sort asc,id desc')->paginate($pageSize);
        if (empty($list->total())) {
            return $this->jump404();
        }
        if ($list->getCurrentPage() > $list->lastPage()) {
            return redirect($type ? "/category/{$type}" : "/");
        }
        //      顶部轮播图 start
        $map[] = ['isbanner', '=', 1];
        $map[] = ['status', '=', 1];
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
