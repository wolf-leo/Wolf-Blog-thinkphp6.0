<?php

declare (strict_types=1);

namespace app;

use think\facade\View;

/**
 * 控制器基础类
 */
class InstallBaseController
{
    public function __construct()
    {
        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {
        View::engine()->layout('layout/default');
        $version = \think\App::VERSION;
        $powered = "WolfCode-内容管理系统[ThinkPHP{$version}]";
        View::assign([
                         'version'        => '1.0',
                         'powered'        => $powered,
                         'default_dbname' => 'wolfcode_blog',
                         'wolfcode_url'   => AUTHOR_SITE_URL,
                     ]);
    }

    public function jump404()
    {
        //只有在app_debug=False时才会正常显示404页面，否则会有相应的错误警告提示
        abort(404, '页面异常');
    }

    //空方法
    public function _empty()
    {
        return $this->jump404();
    }

}
