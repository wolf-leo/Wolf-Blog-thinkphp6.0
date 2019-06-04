<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// [ 应用入口文件 ]

namespace think;

require __DIR__ . '/../vendor/autoload.php';

/**
 *  INSTALL_SQL 是否自动安装数据库 
 *  TRUE=>默认安装
 *  FALSE=>取消默认安装【需要自行安装，详情阅读 必读——博客源码说明.md】
 *  项目正式上线后 请删除以下自动安装数据库的相关代码或者把INSTALL_SQL值设为FALSE
 */
/** -------安装数据库 Start-------------------------- */
define('INSTALL_SQL', TRUE);
if (INSTALL_SQL) {
	$lock_file = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'extend' . DIRECTORY_SEPARATOR . 'installsql.lock';
	if (!file_exists($lock_file)) {
		header('Location:/installsql.php');
		exit;
	}
}


// 执行HTTP应用并响应
$http = (new App())->http;

$response = $http->run();

$response->send();

$http->end($response);
