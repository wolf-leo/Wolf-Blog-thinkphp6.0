<?php

namespace app\index\controller;

use app\admin\model\Article;
use app\BlogBaseController;
use think\facade\View;

class Info extends BlogBaseController
{


    public function index()
    {
        $id = input('id/d', 0);
        if (!$id) {
            return $this->jump404();
        }
        $info = Article::find($id);
        if (!$info) {
            return $this->jump404();
        }
        View::assign([
                         'info'  => $info,
                         'type'  => $info['type'],
                         'title' => $info['title'],
                     ]);
        return $this->blogTpl();
    }

}
