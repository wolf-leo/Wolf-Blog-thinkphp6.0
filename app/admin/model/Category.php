<?php

namespace app\admin\model;

use think\Model;

class Category extends Model {

	public $notes = [
		'status' => [1 => '正常', 2 => '禁用'],
	];

}
