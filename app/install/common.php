<?php

function testwrite($d) {
	$tfile = "test.txt";
	$fp = @fopen($d . "/" . $tfile, "w");
	if (!$fp) {
		return false;
	}
	fclose($fp);
	$rs = @unlink($d . "/" . $tfile);
	if ($rs) {
		return true;
	}
	return false;
}

function sql_split($sql, $tablepre) {
	if ($tablepre != "yzm_")
		$sql = str_replace("yzm_", $tablepre, $sql);
	$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach ($queriesarray as $query) {
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		$queries = array_filter($queries);
		foreach ($queries as $query) {
			$str1 = substr($query, 0, 1);
			if ($str1 != '#' && $str1 != '-')
				$ret[$num] .= $query;
		}
		$num++;
	}
	return $ret;
}

function correct_span($text = '', $type = 1) {
	$type_s = '';
	$type_p = 'success_span_p';
	if ($type == 0) {
		$type_s = 'error_span';
		$type_p = 'error_span_p';
	}
	return "<span class='correct_span {$type_s}'>&radic;</span><span class='{$type_p}'> " . $text . "</span>";
}
