<?php

namespace app\admin\controller;

use app\AdminBaseController;
use think\facade\View;

class Background extends AdminBaseController
{

    protected $mod;

    public function __construct()
    {
        parent::__construct();
        $this->mod = new \app\admin\model\Background();
        View::assign([
                         'notes' => $this->mod->notes,
                     ]);
    }

    public function index()
    {
        $pageSize = 5; //每页显示的数量
        $where    = [];
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
    public function edit()
    {
        $id   = input('id/d', 0);
        $info = $this->mod->where('id', $id)->find();
        if (!request()->isPost()) {
            View::assign(['info' => $info,]);
            return $this->adminTpl();
        }
        $data = input('post.');
        unset($data['id']);
        $file = $file2 = '';
        if (!empty($_FILES['head_back_img']['tmp_name'])) {
            $file = request()->file('head_back_img'); //图片上传
        }
        if (!empty($_FILES['main_back_img']['tmp_name'])) {
            $file2 = request()->file('main_back_img'); //图片上传
        }
        $img_path = config()['filesystem']['disks']['public']['url'];
        if ($file) {
            $savename = \think\facade\Filesystem::disk('public')->putFile('topic', $file, 'md5');
            if ($savename) {
                $data['head_back_img'] = $img_path . DIRECTORY_SEPARATOR . $savename;
            }
        }
        if ($file2) {
            $savename2 = \think\facade\Filesystem::disk('public')->putFile('topic', $file2, 'md5');
            if ($savename2) {
                $data['main_back_img'] = $img_path . DIRECTORY_SEPARATOR . $savename2;
            }
        }
        if ($id) { //更新数据
            $where['id'] = $id;
            $x           = $this->mod->where($where)->update($data);
        } else { //添加数据
            $data['c_time'] = date('Y-m-d H:i:s');
            $x              = $this->mod->insertGetId($data);
        }
        return $x ? $this->jump(1, '修改成功') : $this->jump(0, '修改失败');
    }

}
