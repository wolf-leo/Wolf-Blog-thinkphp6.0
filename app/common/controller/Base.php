<?php

namespace app\common\controller;

use think\Controller;

class Base extends Controller {

	public function __construct() {
		parent::__construct(\App());
		include_once dirname(dirname(__FILE__)) . "/const.php";
		include_once dirname(dirname(__FILE__)) . "/define.php";
	}

}
