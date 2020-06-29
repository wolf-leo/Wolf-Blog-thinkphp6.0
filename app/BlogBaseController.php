<?php

declare (strict_types=1);

namespace app;

use think\facade\View;
use app\BaseController;

/**
 * 控制器基础类
 */
class BlogBaseController extends BaseController
{

    public function __construct() {
        include_once dirname(__FILE__) . "/define.php";
        $this->initialize();
    }

    // 初始化
    protected function initialize() {
        $this->checkInstall();
    }

    protected function checkInstall() {
        $lock_file = root_path() . 'wcore' . DIRECTORY_SEPARATOR . 'install.lock';
        if (file_exists($lock_file)) {
            return TRUE;
        }
        header("Location:/install.php");
        exit;
    }

    public function jump404() {
        //只有在app_debug=False时才会正常显示404页面，否则会有相应的错误警告提示
        abort(404, '页面异常');
    }

    public function blogTpl() {
        $category = new admin\model\Category;
        $background = new admin\model\Background;
        $headernav = $category->where(['status' => 1])->order('sort asc')->column('title', 'id');
        $backimg = $background->find(1);
        View::assign(['headernav' => $headernav, 'backimg' => $backimg]);
        return View::fetch('public/head') . View::fetch() . View::fetch('public/foot');
    }

    //空方法
    public function _empty() {
        return $this->jump404();
    }

}
