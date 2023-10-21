<?php
include 'main_script.php';


if (!isset($_GET['id'])) {
    echo '<script> window.location.href = "lk.php"; </script>';
} else {

    echo " <a href=lk.php > Мой профиль</a></br></br>";

    $name = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_hash` LIKE '$hashh'");
    while ($row = $name->fetch_assoc()) {

        echo ("Привет   " . $row['user_name'] . "</br></br>");
    }

    $user_logined_id2 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'");
    while ($user_logined_id1 = $user_logined_id2->fetch_assoc()) {
        $user_logined_id = $user_logined_id1['user_id'];
    }

    $id = $_GET['id'];
    $group_id2 = mysqli_query($link, "SELECT `group_name` FROM `groups` WHERE `group_id` LIKE
    '$id'"); // имя
    while ($group_id1 = $group_id2->fetch_assoc()) {
        $group_id = $group_id1["group_name"];
        echo "Группа - " . $group_id1['group_name'] . "   ";
    }

    $group_user_admin2 = mysqli_query($link, "SELECT `group_user_admin` FROM `groups` WHERE `group_id` LIKE '$id'");
    while ($group_user_admin1 = $group_user_admin2->fetch_assoc()) {

        $user_id1 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'");
        while ($user_id2 = $user_id1->fetch_assoc()) {
            $user_id = $user_id2["user_id"];
        }

        $group_user_admin = $group_user_admin1['group_user_admin'];
        if ($group_user_admin == $user_id) {
            echo "Вы менеджер этой группы ";



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


                echo ('<form method="POST">
                Добавить участника: <input name="text" type="textarea" value="Введите имя"> </br>
                </form>
                <form method="POST">
                Добавить задачу: <input name="task_add" type="textarea" value="Введите название">
                </form>');

                if (!isset($_POST['text'])) {
                } else {
                    $text = $_POST['text'];
                    $user_id3 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_name` LIKE '%$text%'");
                    while ($user_id2 = $user_id3->fetch_assoc()) {
                        $user_id = $user_id2['user_id'];
                        echo $user_id;
                    }

                    array_push($cart, $user_id);
                    sort($cart);
                    $cartt = implode(",", $cart);
                    mysqli_query($link, "UPDATE `groups` SET `group_slaves`='$cartt' WHERE `group_id` LIKE '$id'");
                    echo '<script> window.location.href = "group_info.php?id=' . $id . '"; </script>';
                }










                echo ("Задачи:   </br>");


                $group_tasks3 = mysqli_query($link, "SELECT `group_tasks` FROM `groups` WHERE `group_id` LIKE '$id'");
                while ($group_tasks2 = $group_tasks3->fetch_assoc()) {
                    $group_tasks2['group_tasks'] = str_replace('[', ',', $group_tasks2['group_tasks']);
                    $group_tasks2['group_tasks'] = str_replace(']', ',', $group_tasks2['group_tasks']);
                    $group_tasks2['group_tasks'] = str_replace('0', ',', $group_tasks2['group_tasks']);
                    $group_tasks2['group_tasks'] = str_replace('', ',,', $group_tasks2['group_tasks']);
                    $group_tasks = explode(",", $group_tasks2['group_tasks']);
                    $group_tasks_count = count($group_tasks, true) - 1;
                }


                if (!isset($_POST['task_add'])) { // Задачи добавить
                } else {
                    $task_add = $_POST['task_add'];
                    $task_id3 = mysqli_query($link, "SELECT `task_id` FROM `tasks` WHERE `task_name` LIKE '%$task_add%'");
                    while ($task_id2 = $task_id3->fetch_assoc()) {
                        $task_id = $task_id2['task_id'];
                    }
                    array_push($group_tasks, $task_id);
                    sort($group_tasks);
                    $taskkk = implode(",", $group_tasks);
                    mysqli_query($link, "UPDATE `groups` SET `group_tasks`='$taskkk' WHERE `group_id` LIKE '$id'");
                    echo '<script> window.location.href = "group_info.php?id=' . $id . '"; </script>';

                }


                while (-1 < $group_tasks_count) {
                    $task_name2 = mysqli_query($link, "SELECT `task_name` FROM `tasks` WHERE `task_id` LIKE '$group_tasks[$group_tasks_count]'"); // имя тасков
                    while ($task_name1 = $task_name2->fetch_assoc()) {
                        $task_goal2 = mysqli_query($link, "SELECT `task_goal` FROM `tasks` WHERE `task_id` LIKE '$group_tasks[$group_tasks_count]'"); // имя тасков
                        while ($task_goal1 = $task_goal2->fetch_assoc()) {
                            $task_goal = $task_goal1["task_goal"];
                        }
                        $task_time2 = mysqli_query($link, "SELECT `task_time` FROM `tasks` WHERE `task_id` LIKE '$group_tasks[$group_tasks_count]'"); // имя тасков
                        while ($task_time1 = $task_time2->fetch_assoc()) {
                            $task_time = $task_time1["task_time"];
                        }

                        echo $task_name1['task_name'] . '. </br>   Необходимое количество выполнений - ' . $task_goal . '.</br> Крайнее время выполнения задачи  ' . $task_time;
                        echo "</br>Приступившие к выполнению:    ";

                        $suma = 0;

                        $task_user_state3 = mysqli_query($link, "SELECT `user_name`,`user_count` FROM `user` WHERE `user_count` LIKE '%$group_tasks[$group_tasks_count]%'");
                        while ($task_user_state2 = $task_user_state3->fetch_assoc()) {
                            $task_user_state2['user_count'] = str_replace('[', ',', $task_user_state2['user_count']);
                            $task_user_state2['user_count'] = str_replace(']', ',', $task_user_state2['user_count']);
                            $task_user_state2['user_count'] = str_replace('0', ',', $task_user_state2['user_count']);
                            $task_user_state2['user_count'] = str_replace('', ',,', $task_user_state2['user_count']);
                            $task_user_state2['user_count'] = str_replace('=', ',', $task_user_state2['user_count']);
                            $task_user_state = explode(",", $task_user_state2['user_count']);
                            $task_user_state_count = count($task_user_state, true) - 1;
                            echo '</br>' . $task_user_state2['user_name'] . '  ';
                            //print_r($task_user_state);
                            while (-1 < $task_user_state_count) {
                                if ($task_user_state[$task_user_state_count] == $group_tasks[$group_tasks_count]) {
                                    $suma = $suma + 1;
                                }

                                $task_user_state_count = $task_user_state_count - 1;
                            }
                            echo $suma . '  выполнений';




                        }





                        echo '<form method="POST">
                        <input name="delete_task' . $group_tasks_count . '" type="submit" value="удалить задачу">
                        </form>';
                        if (!isset($_POST['delete_task' . $group_tasks_count . ''])) {
                        } else {
                            $group_tasks[$group_tasks_count] = "";
                            $group_tasks_mas = implode(",", $group_tasks);
                            mysqli_query($link, "UPDATE `groups` SET `group_tasks`='$group_tasks_mas' WHERE `group_id` LIKE '$id'");
                            echo '<script> window.location.href = "group_info.php?id=' . $id . '"; </script>';
                        }
                    }
                    $group_tasks_count = $group_tasks_count - 1;

                }





                $i = count($cart, true) - 1;
                echo ("</br> Участники:    </br>");
                while (-1 < $i) {
                    $result = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_id` LIKE '$cart[$i]'"); // имя юзеров
                    while ($row = $result->fetch_assoc()) {
                        echo "<a href='user_info.php?id=" . $cart[$i] . "'>" . $row['user_name'] . "</a>";
                        echo '<form method="POST">
                        <input name="delete' . $i . '" type="submit" value="удалить">
                        </form>';
                        if (!isset($_POST['delete' . $i . ''])) {
                        } else {
                            $cart[$i] = "";
                            $cartt = implode(",", $cart);
                            mysqli_query($link, "UPDATE `groups` SET `group_slaves`='$cartt' WHERE `group_id` LIKE '$id'");
                            echo '<script> window.location.href = "group_info.php?id=' . $id . '"; </script>';
                        }
                    }
                    $i = $i - 1;
                }
                echo ("</br>");
            }

        } else {
            echo ("</br> Задачи:   </br>");

            $group_tasks3 = mysqli_query($link, "SELECT `group_tasks` FROM `groups` WHERE `group_id` LIKE '$id'");
            while ($group_tasks2 = $group_tasks3->fetch_assoc()) {
                $group_tasks2['group_tasks'] = str_replace('[', ',', $group_tasks2['group_tasks']);
                $group_tasks2['group_tasks'] = str_replace(']', ',', $group_tasks2['group_tasks']);
                $group_tasks2['group_tasks'] = str_replace('0', ',', $group_tasks2['group_tasks']);
                $group_tasks2['group_tasks'] = str_replace('', ',,', $group_tasks2['group_tasks']);
                $group_tasks = explode(",", $group_tasks2['group_tasks']);
                $group_tasks_count = count($group_tasks, true) - 1;
            }



            while (-1 < $group_tasks_count) {
                $task_name2 = mysqli_query($link, "SELECT `task_name` FROM `tasks` WHERE `task_id` LIKE '$group_tasks[$group_tasks_count]'"); // имя тасков
                while ($task_name1 = $task_name2->fetch_assoc()) {
                    $task_goal2 = mysqli_query($link, "SELECT `task_goal` FROM `tasks` WHERE `task_id` LIKE '$group_tasks[$group_tasks_count]'"); // имя тасков
                    while ($task_goal1 = $task_goal2->fetch_assoc()) {
                        $task_goal = $task_goal1["task_goal"];
                    }
                    $task_time2 = mysqli_query($link, "SELECT `task_time` FROM `tasks` WHERE `task_id` LIKE '$group_tasks[$group_tasks_count]'"); // имя тасков
                    while ($task_time1 = $task_time2->fetch_assoc()) {
                        $task_time = $task_time1["task_time"];
                    }

                    echo $task_name1['task_name'] . '. </br>   Необходимое количество выполнений - ' . $task_goal . '.</br> Крайнее время выполнения задачи  ' . $task_time;
                    echo "</br>Приступившие к выполнению:    ";

                    $task_user_state3 = mysqli_query($link, "SELECT `user_name`,`user_count` FROM `user` WHERE `user_count` LIKE '%$group_tasks[$group_tasks_count]%'");
                    while ($task_user_state2 = $task_user_state3->fetch_assoc()) {
                        $task_user_state2['user_count'] = str_replace('[', ',', $task_user_state2['user_count']);
                        $task_user_state2['user_count'] = str_replace(']', ',', $task_user_state2['user_count']);
                        $task_user_state2['user_count'] = str_replace('0', ',', $task_user_state2['user_count']);
                        $task_user_state2['user_count'] = str_replace('', ',,', $task_user_state2['user_count']);
                        $task_user_state2['user_count'] = str_replace('=', ',', $task_user_state2['user_count']);
                        $task_user_state = explode(",", $task_user_state2['user_count']);
                        $task_user_state_count = count($task_user_state, true) - 1;
                        echo '</br>' . $task_user_state2['user_name'] . '  ';
                        $suma = 0;
                        //print_r($task_user_state);
                        while (-1 < $task_user_state_count) {
                            if ($task_user_state[$task_user_state_count] == $group_tasks[$group_tasks_count]) {
                                $suma = $suma + 1;
                            }

                            $task_user_state_count = $task_user_state_count - 1;
                        }

                        //print_r($task_user_state);
                        if (!isset($_POST['add' . $group_tasks_count . ''])) {
                        } else {
                            array_push($task_user_state, $group_tasks[$group_tasks_count]);
                            sort($task_user_state);
                            $task_user_state = implode(",", $task_user_state);
                            mysqli_query($link, "UPDATE `user` SET `user_count`='$task_user_state' WHERE `user_id` LIKE '$user_logined_id'");
                            echo '<script> window.location.href = "group_info.php?id=' . $id . '"; </script>';
                        }

                        echo $suma . '  выполнений';

                    }


                    echo '<form method="POST">
                        <input name="add' . $group_tasks_count . '" type="submit" value="Выполнил">
                        </form>';


                }
                $group_tasks_count = $group_tasks_count - 1;

            }
        }

    }





}
?>