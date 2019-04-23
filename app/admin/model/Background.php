<?php

namespace app\admin\model;

use app\common\model\Commonmodel;

class Background extends Commonmodel {

	// 设置当前模型对应的完整数据表名称
	protected $table = 'background';
	protected $pk = 'id'; //主键

	public function __construct($data = []) {
		parent::__construct($data);
	}

	public $notes = array(//数值注释
		'is_head' => array(1 => '开启', 2 => '关闭'),
		'is_main' => array(1 => '开启', 2 => '关闭'),
	);

}
