<?php

namespace app\common\model;

use think\Model;

class Commonmodel extends Model {

	public function __construct($data = []) {
		parent::__construct($data);
	}

	public function _parwhere($where = array()) {
		if (empty($where)) {
			return array();
		}
		$ping = '';
		foreach ($where as $key => $value) {
			if (is_array($value)) {
				$ping .= implode(',', $value);
			}
		}
		return $ping;
	}

	public function _pageparam() {
		$param = \think\facade\Request::param() ?: [];
		$controller = strtolower(CONTROLLER_NAME) == 'index' ? null : strtolower(CONTROLLER_NAME) . '/';
		$action = strtolower(ACTION_NAME) == 'index' ? null : strtolower(ACTION_NAME) . '/';
		$module = strtolower(MODULE_NAME) == 'index' ? null : '/' . strtolower(MODULE_NAME);
		if (isset(array_keys($param)[0])) {
			unset($param[array_keys($param)[0]]);
		}
		if ($module == 'admin') {
			return ['query' => $param, 'path' => url("admin/$controller/$action")];
		} else {
			return ['query' => $param, 'path' => '/' . request()->pathinfo()];
		}
	}

}
