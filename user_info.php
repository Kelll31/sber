<?php
include 'main_script.php';

if (!isset($_GET['id'])) {
    echo '<script> window.location.href = "lk.php"; </script>';
} else {
    echo " <a href=lk.php > Мой профиль</a></br></br>";

    $user_id = $_GET['id'];
    $user_name2 = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_id` LIKE
    '$user_id'"); // имя
    while ($user_name1 = $user_name2->fetch_assoc()) {
        echo "Юзер " . $user_name1['user_name'];
        $user_name = $user_name1['user_name'];
    }
    echo "</br> Группы в которых он участвует: </br>";
    $group_user_admin2 = mysqli_query($link, "SELECT `group_name` FROM `groups` WHERE `group_user_admin` LIKE '%$user_id%'"); //менеджер
    while ($group_user_admin1 = $group_user_admin2->fetch_assoc()) {
        $group_user_admin2 = mysqli_query($link, "SELECT `group_id` FROM `groups` WHERE `group_user_admin` LIKE '%$user_id%'");
        $group_user_admin = $group_user_admin1['group_name'];
        $group_id2 = mysqli_query($link, "SELECT `group_id` FROM `groups` WHERE `group_name` LIKE '$group_name'");
        while ($group_id1 = $group_id2->fetch_assoc()) {
            $group_id = $group_id1['group_id'];
        }

        echo "Участник как менеджер - <a href='group_info.php?id=" . $group_id . "'>" . $group_name1['group_name'] . "</a></br>";
    }



    $group_name2 = mysqli_query($link, "SELECT `group_name` FROM `groups` WHERE `group_slaves` LIKE '%$user_id%'"); //раб
    while ($group_name1 = $group_name2->fetch_assoc()) {
        $group_name = $group_name1['group_name'];

        $group_id2 = mysqli_query($link, "SELECT `group_id` FROM `groups` WHERE `group_name` LIKE '$group_name'");
        while ($group_id1 = $group_id2->fetch_assoc()) {
            $group_id = $group_id1['group_id'];
        }
        echo "Участник как раб - <a href='group_info.php?id=" . $group_id . "'>" . $group_name1['group_name'] . "</a> </br>";
    }

}
?>