<?php
include 'main_script.php';

if (!isset($_GET['id'])) {
    echo '<script> window.location.href = "lk.php"; </script>';
} else {

    echo " <a href=lk.php > Мой профиль</a></br></br>";

    $id = $_GET['id'];
    $group_id2 = mysqli_query($link, "SELECT `group_name` FROM `groups` WHERE `group_id` LIKE
    '$id'"); // имя
    while ($group_id1 = $group_id2->fetch_assoc()) {
        $group_id = $group_id1["group_name"];
        echo "Группа - ". $group_id1['group_name'];
    }

    $result = mysqli_query($link, "SELECT `group_slaves` FROM `groups` WHERE `group_id` LIKE '$id'");
    while ($data = $result->fetch_assoc()) {
        $data['group_slaves'] = str_replace('[', ',', $data['group_slaves']);
        $data['group_slaves'] = str_replace(']', ',', $data['group_slaves']);
        $data['group_slaves'] = str_replace('0', ',', $data['group_slaves']);
        $data['group_slaves'] = str_replace('', ',,', $data['group_slaves']);
        $cart = explode(",", $data['group_slaves']);
        $i = count($cart, true) - 1;
        $ii = 1;
        // echo ($data['group_slaves']);


        echo ("</br> участники:    ");
        while (-1 < $i) {
            $result = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_id` LIKE '$cart[$i]'"); // имя юзеров
            while ($row = $result->fetch_assoc()) {
                echo "<a href='user_info.php?id=" . $cart[$i] . "'>" . $row['user_name'] . "</a> , ";
            }
            $i = $i - 1;
        }
        echo ("</br>");
    }




}
?>