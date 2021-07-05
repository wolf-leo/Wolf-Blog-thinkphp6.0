<?php

namespace app\admin\controller;

use app\AdminBaseController;
use think\facade\View;

class Article extends AdminBaseController
{

    protected $mod;

    public function __construct()
    {
        parent::__construct();
        $this->mod = new \app\admin\model\Article();
        $category  = new \app\admin\model\Category();
        $type      = $category->where(['status' => 1])->orderRaw('sort')->column('title', 'id');
        View::assign([
                         'notes' => $this->mod->notes,
                         'type'  => $type,
                     ]);
    }

    public function index()
    {
        $pageSize = 5; //每页显示的数量
        $where    = [];
        if (input('id')) {
            $where[] = ['id', '=', input('id')];
        }
        $list = $this->mod->where($where)->order('id', 'desc')->paginate($pageSize);
        View::assign(['list' => $list]);
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
        $file      = '';
        $file_path = base_path() . 'public' . DIRECTORY_SEPARATOR . 'uploads';
        if (!empty($_FILES['img']['tmp_name'])) {
            $file = request()->file('img'); //图片上传
        }
        if ($file) {
            $img_path = config()['filesystem']['disks']['public']['url'];
            $savename = \think\facade\Filesystem::disk('public')->putFile('topic', $file, 'md5');
            if ($savename) {
                $data['img'] = $img_path . DIRECTORY_SEPARATOR . $savename;
            } else {
                return $this->jump(0, $file->getError());
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

    /**
     * Windows 环境下如果遇到
     * upload_tmp_dir 临时文件夹问题
     * 上传文件提示
     * Warning: File upload error - unable to create a temporary file in Unknown on line 0
     * 找到php.ini 中的 upload_tmp_dir 把前边的“；”去掉然后改为upload_tmp_dir =C:\Windows\temp
     * 最后记得重启apache
     */
    //  编辑器图片上传 【单张上传操作，多图上传自行研究- -】
    public function UploadPic()
    {
        $file = request()->file('info_upload_img');
        // 上传到本地服务器
        $savename = \think\facade\Filesystem::disk('public')->putFile('articlepic', $file);
        if ($savename) {
            $img = "/uploads/" . $savename;
            $ret = ["errno" => 0, 'data' => [$img]];
            return json($ret);
        } else {
            return $this->jump(0, $file->getError());
        }
    }

}
