<?php

namespace app\admin\model;

use think\Model;

class Background extends Model {

	public $notes = [
		'status' => [1 => '正常', 2 => '禁用'],
		'is_head' => [1 => '开启', 2 => '关闭'],
		'is_main' => [1 => '开启', 2 => '关闭'],
	];

}
