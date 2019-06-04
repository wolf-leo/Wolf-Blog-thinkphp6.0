<?php

namespace app\common\controller;

use think\facade\Request;
use think\facade\View;

class Base {

	public function __construct() {
		include_once dirname(dirname(__FILE__)) . "/const.php";
		include_once dirname(dirname(__FILE__)) . "/define.php";
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
	public function jump($code = 1, $msg = '', $url = null, $data = '', $wait = 3, array $header = []) {
		if (is_null($url)) {
			$url = Request::isAjax() ? '' : 'javascript:history.back(-1);';
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
