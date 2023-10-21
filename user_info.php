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

    $group_name2 = mysqli_query($link, "SELECT `group_name` FROM `groups` WHERE `group_user_admin` LIKE '%$user_id%'"); //менеджер
    while ($group_name1 = $group_name2->fetch_assoc()) {
        $group_name = $group_name1['group_name'];
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

        $task_user_state3 = mysqli_query($link, "SELECT `user_count` FROM `user` WHERE `user_id` LIKE '$user_id'");
        while ($task_user_state2 = $task_user_state3->fetch_assoc()) {
            $task_user_state2['user_count'] = str_replace('[', ',', $task_user_state2['user_count']);
            $task_user_state2['user_count'] = str_replace(']', ',', $task_user_state2['user_count']);
            $task_user_state2['user_count'] = str_replace('0', ',', $task_user_state2['user_count']);
            $task_user_state2['user_count'] = str_replace('', ',,', $task_user_state2['user_count']);
            $task_user_state2['user_count'] = str_replace('=', ',', $task_user_state2['user_count']);
            $task_user_state = explode(",", $task_user_state2['user_count']);
            $task_user_state_count = count($task_user_state, true) - 1;


            $bubuq = [];
            foreach ($task_user_state as $key => $value) {
                if (empty($bubuq[$value])) {
                    $bubuq[$value] = 0;
                } else {
                }
                $bubuq[$value] = $bubuq[$value] + 1;

            }


            foreach ($bubuq as $key => $value) {
                //echo $key . "\t=>\t" . $value . "\n";

                $task_name3 = mysqli_query($link, "SELECT `task_name` FROM `tasks` WHERE `task_id` LIKE '$key'");
                while ($task_name2 = $task_name3->fetch_assoc()) {
                    $task_name = $task_name2['task_name'];
                    echo $task_name . "- выполнено " . $value . "    раз;  ";
                }

            }

        }






        echo "Участник как раб - <a href='group_info.php?id=" . $group_id . "'>" . $group_name1['group_name'] . "</a> </br>";
    }


}
?>