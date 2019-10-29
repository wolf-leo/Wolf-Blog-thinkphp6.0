<?php

// 应用公共文件
function checkWap() {
	$HTTP_X_WAP_PROFILE = !empty($_SERVER['HTTP_X_WAP_PROFILE']) ?: null;
	$HTTP_ACCEPT = $_SERVER['HTTP_ACCEPT'];
	$HTTP_USER_AGENT = strtolower($_SERVER['HTTP_USER_AGENT']);
	$HTTP_VIA = !empty($_SERVER['HTTP_VIA']) ?: null;
	// 如果有HTTP_X_WAP_PROFILE则一定是移动设备  
	if (isset($HTTP_X_WAP_PROFILE)) {
		return true;
	}
	// 先检查是否为wap代理，准确度高
	if (stristr($HTTP_VIA, "wap")) {
		return true;
	}
	// 检查浏览器是否接受 WML.
	elseif (strpos(strtoupper($HTTP_ACCEPT), "VND.WAP.WML") > 0) {
		return true;
	}
	//检查USER_AGENT
	elseif (preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |googlebot-mobile|yahooseeker\/m1a1-r2d2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|ucweb|xda |xda_)/i', $HTTP_USER_AGENT)) {
		return true;
	} else {
		return false;
	}
}

/**
 *  后台admin用户密码
 * @param string $password
 */
function AdminPassword(string $password): string {
	$en = md5(substr(md5($password), 2, 10));
	return $en;
}
