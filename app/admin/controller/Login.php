<?php

namespace app\admin\controller;

use think\facade\View;
use think\captcha\facade\Captcha;

class Login {

	public function index() {
		return View::fetch();
	}

	public function login() {
		if (!request()->isPost()) {
			return $this->jump404();
		}
		$username = input('username/s', '');
		$password = input('password/s', '');
		$captcha = input('captcha/d', 0);
		$errorret = [
			'status' => -1,
			'msg' => '账号/密码错误'
		];
		$successret = [
			'status' => 1000,
			'msg' => '登录成功'
		];
		if (empty($username) || empty($password)) {
			return json($errorret);
		}
		if (!captcha_check($captcha)) {
			$errorret['msg'] = '验证码错误';
			return json($errorret);
		}
		$mod = new \app\admin\model\Admin();
		$where[] = ['adminname', '=', $username];
		$where[] = ['status', '=', 1];
		$info = $mod->where($where)->find();
		if (empty($info)) {
			return json($errorret);
		}
		$info_password = $info['password'];
		if ($info_password !== AdminPassword($password)) {
			return json($errorret);
		}
		session('admin_uid', $info['adminid']);
		return json($successret);
	}

	public function captcha() {
		return Captcha::create('verify');
	}

	public function out() {
		session('admin_uid', null);
		$url = (string) url('/Index');
		return redirect($url);
	}

}
