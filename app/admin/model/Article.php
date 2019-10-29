<?php

namespace app\admin\model;

use think\Model;

class Article extends Model {

	public $notes = [
		'status' => [1 => '正常', 2 => '禁用'],
		'isbanner' => [1 => '推荐', 2 => '不推荐',],
	];

}
