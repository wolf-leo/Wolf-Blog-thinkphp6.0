<?php

/**
 * 集成某些Thinkphp3.2 常用常量
 */
use think\facade\Request;

define('IS_POST', Request::isPost());
define('IS_AJAX', Request::isAjax());
define('IS_GET', Request::isGet());
define('CONTROLLER_NAME', Request::controller());
define('ACTION_NAME', Request::action());
define('MODULE_NAME', Request::app());
