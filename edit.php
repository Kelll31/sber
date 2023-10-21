<?php

include 'main_script.php';
$hashh = $_COOKIE["hash"];

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
    </form>';

    if (isset($_POST['task_name'])) {
        $task_name = $_POST['task_name'];
    }
    if (isset($_POST['task_goal'])) {
        $task_goal = $_POST['task_goal'];
    }
    if (isset($_POST['task_time'])) {
        $task_time = $_POST['task_time'];
    }
    if (!isset($_POST['submitt'])) {
    } else {
        mysqli_query($link, "INSERT INTO `tasks`(`task_name`, `task_goal`, `task_time`) VALUES ('$task_name','$task_goal','$task_time')");
    }
}
?>