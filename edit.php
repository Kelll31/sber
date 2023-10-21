<?php

include 'main_script.php';
$hashh = $_COOKIE["hash"];
$name = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_hash` LIKE '$hashh'");
while ($row = $name->fetch_assoc()) {

    echo ("Привет   " . $row['user_name'] . "</br>");
}
$user_id1 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'");
while ($user_id2 = $user_id1->fetch_assoc()) {
    $user_id = $user_id2["user_id"];
}
if (isset($_GET['mode'])) {
} else {
    echo '<script> window.location.href = "lk.php"; </script>';
}
echo " <a href=lk.php > Мой профиль</a></br></br>";
if ($_GET['mode'] == 0) { //режим создания группы
    $user_id2 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'"); // имя юзеров
    while ($user_id1 = $user_id2->fetch_assoc()) {
        $user_id = $user_id1['user_id'];
    }

    echo "Режим создания группы";

    echo '<form method="POST">
    Название группы <input name="group_name" type="text" required><br>
    Описание группы <input name="group_text" type="text" required><br>
    задачи группы <input name="group_tasks" type="text" required><br>
    <input name="submitt" type="submit" value="создать">
    </form>';

    if (isset($_POST['group_name'])) {
        $group_name = $_POST['group_name'];
    }
    if (isset($_POST['group_text'])) {
        $group_text = $_POST['group_text'];
    }
    if (isset($_POST['group_tasks'])) {
        $group_tasks = $_POST['group_tasks'];
    }
    if (!isset($_POST['submitt'])) {
    } else {
        mysqli_query($link, "INSERT INTO `groups`(`group_text`, `group_name`, `group_tasks`, `group_user_admin`) VALUES ('$group_text','$group_name','$group_tasks',' $user_id')");
        $max2 = mysqli_query($link, "SELECT MAX(`group_id`) FROM `groups` WHERE 1");
        while ($max1 = $max2->fetch_assoc()) {
            $max = $max1['MAX(`group_id`)'];
            echo $max;
        }
        echo '<script> window.location.href = "group_info.php?id=' . $max . '"; </script>';
    }
}

if ($_GET['mode'] == 1) { // режим создания задачи
    echo "Режим создания задачи";

    echo '<form method="POST">
    Название задачи <input name="task_name" type="text" required><br>
    Необходимое количество <input name="task_goal" type="text" required><br>
    Выполнить до <input name="task_time" type="date" required><br>
    <input name="submitt" type="submit" value="создать">
    </form>
    Список ваших задач: </br>';

    $task2 = mysqli_query($link, "SELECT `task_name`,`task_goal`,`task_time` FROM `tasks` WHERE `task_user_admin` LIKE '$user_id'");
    while ($task1 = $task2->fetch_assoc()) {
        $task_name = $task1['task_name'];
        $task_goal = $task1['task_goal'];
        $task_time = $task1['task_time'];
        $i = count($task1, true) - 1;

        $task_id2 = mysqli_query($link, " SELECT `task_id` FROM `tasks` WHERE `task_name` LIKE '$task_name'");
        while ($task_id1 = $task_id2->fetch_assoc()) {
            $task_id = $task_id1['task_id'];

            echo " <a href=edit.php?mode=1&id=" . $task_id . " > " . $task_name . "</a></br>";
        }


        $i = $i - 1;



    }
    if (!isset($_GET["id"])) {
    } else {
        $task_id_select = $_GET["id"];

        $task_name2 = mysqli_query($link, "SELECT `task_name`,`task_goal`,`task_time` FROM `tasks` WHERE `task_id` LIKE '$task_id_select'");
        while ($task_name1 = $task_name2->fetch_assoc()) {
            $task_name = $task_name1['task_name'];
            $task_goal = $task_name1['task_goal'];
            $task_time = $task_name1['task_time'];


            echo '
            </br>
            <form method="POST">
                Название задачи <input name="task_name_edit" type="text" value="' . $task_name . '"><br>
                Необходимое количество <input name="task_goal_edit" type="text" value="' . $task_goal . '"><br>
                Выполнить до <input name="task_time_edit" type="date" value="' . $task_time . '"><br>
                <input name="submitt_edit" type="submit" value="редактировать">
                </form>';
        }
    }

    if (isset($_POST['task_name'])) {
        $task_name = $_POST['task_name'];
    } else {
        $task_name = 0;
    }
    if (isset($_POST['task_goal'])) {
        $task_goal = $_POST['task_goal'];
    } else {
        $task_goal = 0;
    }
    if (isset($_POST['task_time'])) {
        $task_time = $_POST['task_time'];
    } else {
        $task_time = 0;
    }
    if (!isset($_POST['submitt'])) {
    } else {
        mysqli_query($link, "INSERT INTO `tasks`(`task_name`, `task_goal`, `task_time`) VALUES ('$task_name','$task_goal','$task_time')");
        echo '<script> window.location.href = "edit.php?mode=1"; </script>';

    }

    if (isset($_POST['task_name_edit'])) {
        $task_name_edit = $_POST['task_name_edit'];
    } else {
        $task_name_edit = $task_name;
    }
    if (isset($_POST['task_goal_edit'])) {
        $task_goal_edit = $_POST['task_goal_edit'];
    } else {
        $task_goal_edit = $task_goal;
    }
    if (isset($_POST['task_time_edit'])) {
        $task_time_edit = $_POST['task_time_edit'];
    } else {
        $task_time_edit = $task_time;
    }
    if (!isset($_POST['submitt_edit'])) {
    } else {
        mysqli_query($link, "UPDATE `tasks` SET `task_name`='$task_name_edit',`task_goal`='$task_goal_edit',`task_time`='$task_time_edit' WHERE `task_id` LIKE '$task_id_select'");
        echo '<script> window.location.href = "edit.php?mode=1&id=' . $task_id_select . '"; </script>';
    }
}
?>