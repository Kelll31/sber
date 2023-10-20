<?php

$link = mysqli_connect("localhost", "root", "", "sber");
$hashh = 0;
if (!isset($_COOKIE["hash"])) {
	setcookie("hash", generateCode(32), time() + 60 * 60 * 24);
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



//if (mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `user_hash` LIKE '$hashh'")->fetch_array() != 0) {
//	$user_idd = mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `user_hash` LIKE '$hashh'");
//	setcookie("logined", 1, time() + 60 * 60 * 24 * 30);
//} else {
//	setcookie("logined", null, time() + 60 * 60 * 24 * 30);
//	setcookie("id", null, time() + 60 * 60 * 24 * 30);
//}

//$result = mysqli_query($link, "SELECT `user_name` FROM `users` WHERE `user_hash` LIKE '$hashh'");
//while ($row = $result->fetch_assoc()) {
//	echo "Привет " . $row['user_name'] . "<br>";
//}

?>