<?php

namespace app\common\controller;

class Base {
	public function __construct() {
		include_once dirname(dirname(__FILE__)) . "/const.php";
		include_once dirname(dirname(__FILE__)) . "/define.php";
	}
}
