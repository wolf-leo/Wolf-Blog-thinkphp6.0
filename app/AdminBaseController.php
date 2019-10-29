<?php

declare (strict_types=1);

namespace app;

use think\facade\View;

/**
 * 控制器基础类
 */
class AdminBaseController {

	public function __construct() {
		// 控制器初始化
		$this->initialize();
	}

	// 初始化
	protected function initialize() {
		$admin_uid = session('admin_uid');
		if (!$admin_uid) {
			$url = (string) url('/login');
			header("Location:" . $url);
			exit;
		}
	}

	public function jump404() {
		//只有在app_debug=False时才会正常显示404页面，否则会有相应的错误警告提示
		abort(404, '页面异常');
	}

	public function adminTpl() {
		return View::fetch('public/head') . View::fetch() . View::fetch('public/foot');
	}

	public function adminPublicTpl() {
		return View::fetch('public/iframehead') . View::fetch() . View::fetch('public/iframefoot');
	}

	//空方法
	public function _empty() {
		return $this->jump404();
	}

	/**
	 * 页面跳转自定义
	 * @param int $code 1 success 0 error
	 * @param string $msg
	 * @param string $url
	 * @param string $data
	 * @param int $wait
	 * @param array $header
	 */
	public function jump($code = 1, $msg = '', $url = null, $data = '', $wait = 2, array $header = []) {
		if (is_null($url)) {
			$url = request()->isAjax() ? '' : 'javascript:history.back(-1);';
		} elseif ('' !== $url) {
			$url = (strpos($url, '://') || 0 === strpos($url, '/')) ? $url : $this->app['url']->build($url);
		}
		$result = [
			'code' => (int) $code,
			'msg' => $msg,
			'data' => $data,
			'url' => $url,
			'wait' => $wait,
		];
		View::assign($result);
		echo View::fetch('public/head') . View::fetch('public/jump') . View::fetch('public/foot');
		exit;
	}

}
