<?php

$link = mysqli_connect("localhost", "root", "", "sber");
$hashh = 0;
if (!isset($_COOKIE["hash"])) {
	setcookie("hash", generateCode(32), time() + 60 * 60 * 24);
	header('refresh: 0');
} else {
	$hashh = $_COOKIE["hash"];
}
function generateCode($length = 6)
{
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
	$clen = strlen($chars) - 1;
	while (strlen($code) < $length) {
		$code .= $chars[mt_rand(0, $clen)];
	}
	return $code;
}

if (!isset($_COOKIE['shop_bag'])) {
	//setcookie('shop_bag', json_encode($bag), time() + 3600);
} else {
	$data = json_encode(json_decode($_COOKIE['shop_bag'], true));
}




?>