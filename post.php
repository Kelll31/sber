<?php
include 'main_script.php';

$summ = 0;
$scherchik = 0;

if (isset($_GET['post'])) {
    $group_id = $_GET["post"];
    //echo ($group_id);
} else {
    $group_id = 0;
    echo ("Не существующая задача");
}


if (mysqli_query($link, "SELECT `group_slaves` FROM `group` WHERE `group_id` LIKE '$group_id'")->fetch_array() == 0) {
    echo "Вы еще не добавили рабов";
} else {
    $result = mysqli_query($link, "SELECT `group_slaves` FROM `group` WHERE `group_id` LIKE '$group_id'");
    while ($data = $result->fetch_assoc()) {
        $data['group_slaves'] = str_replace('[', ',', $data['group_slaves']);
        $data['group_slaves'] = str_replace(']', ',', $data['group_slaves']);
        $data['group_slaves'] = str_replace('0', ',', $data['group_slaves']);
        $data['group_slaves'] = str_replace('', ',,', $data['group_slaves']);
        $cart = explode(",", $data['group_slaves']);
        $i = count($cart, true) - 1;
        $ii = 1;
        echo ($data['group_slaves']);
        //  while (-1 < $i) {
        //     $result = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `id` LIKE '$cart[$i]'"); // имя юзеров
        //    while ($row = $result->fetch_assoc()) {
        //        echo $row['user_name'];
        //    }
        //    $i = $i - 1;
        // }
    }
}

?>