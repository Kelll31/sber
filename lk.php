<?php
// Страница регистрации нового пользователя

include 'main_script.php';

$hashh = $_COOKIE["hash"];
$reg = $_GET['register'];
if (!isset($_GET['register'])) {
    echo '<script> window.location.href = "lk.php?register=0"; </script>';
}
if (mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'")->fetch_array() != 0) {

    $user_id1 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'");
    while ($user_id2 = $user_id1->fetch_assoc()) {
        $user_id = $user_id2["user_id"];
    }

    $name = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_hash` LIKE '$hashh'");
    while ($row = $name->fetch_assoc()) {

        echo ("Привет   " . $row['user_name'] . "</br>");
    }
    $role2 = mysqli_query($link, "SELECT `user_role` FROM `user` WHERE `user_hash` LIKE '$hashh'");
    while ($role1 = $role2->fetch_assoc()) {
        $role = $role1['user_role'];
    }


    if ($role == "0") { // Права доступа    админ
        echo ("Права доступа    админ   </br>");


    } else if ($role == "1") { // Права доступа    менеджер групп

        echo ("<a href=edit.php?mode=0 >создать группу </a></br></br>");
        echo ("<a href=edit.php?mode=1 >создать задачу </a></br></br>");
        $group_name2 = mysqli_query($link, "SELECT `group_name` FROM `groups` WHERE `group_user_admin` LIKE '$user_id'");
        while ($group_name1 = $group_name2->fetch_assoc()) {
            $group_name = $group_name1['group_name'];

            $group_id2 = mysqli_query($link, "SELECT `group_id` FROM `groups` WHERE `group_name` LIKE '$group_name'");
            while ($group_id1 = $group_id2->fetch_assoc()) {
                $group_id = $group_id1["group_id"];
            }
            $result = mysqli_query($link, "SELECT `group_slaves` FROM `groups` WHERE `group_id` LIKE '$group_id'");
            while ($data = $result->fetch_assoc()) {
                $data['group_slaves'] = str_replace('[', ',', $data['group_slaves']);
                $data['group_slaves'] = str_replace(']', ',', $data['group_slaves']);
                $data['group_slaves'] = str_replace('0', ',', $data['group_slaves']);
                $data['group_slaves'] = str_replace('', ',,', $data['group_slaves']);
                $cart = explode(",", $data['group_slaves']);
                $i = count($cart, true) - 1;
                $ii = 1;
                // echo ($data['group_slaves']);


                echo ("Права доступа:    менеджер  -    группа <a href='group_info.php?id=" . $group_id . "'>" . $group_name . "</a></br> участники:    ");
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

    } else if ($role == "2") { // Права доступа    раб
        $group_name2 = mysqli_query($link, "SELECT `group_name` FROM `groups` WHERE `group_slaves` LIKE '%$user_id%'"); //раб
        while ($group_name1 = $group_name2->fetch_assoc()) {
            $group_name = $group_name1['group_name'];
            $group_id2 = mysqli_query($link, "SELECT `group_id` FROM `groups` WHERE `group_name` LIKE '$group_name'");
            while ($group_id1 = $group_id2->fetch_assoc()) {
                $group_id = $group_id1["group_id"];
            }
            echo ("Права доступа раб   ");
            echo "<a href=group_info.php?id=" . $group_id . "> " . $group_name . "</a> </br>";

        }

    }
    echo ('<form method="POST">
    <input name="exit" type="submit" value="выйти">
    </form>');

    if (isset($_POST['exit'])) {
        mysqli_query($link, "UPDATE `user` SET `user_hash`='0' WHERE `user_hash` LIKE '$hashh'");
        echo '<script> window.location.href = "lk.php"; </script>';
    }


    // header('Location: http://localhost/sber/main.php');
//   header('refresh: 0');
} elseif ($reg == "0") {
    echo ('<form method="POST">
Логин <input name="loginn" type="text" required><br>
Пароль <input name="password" type="password" required><br>
<input name="submitt" type="submit" value="Войти">
</form>
<form method="POST">
<input name="reg" type="submit" value="Регистрация">
</form>
');
    if (isset($_POST['submitt'])) {
        $loginn = $_POST['loginn'];
        $passs = mysqli_query($link, "SELECT `user_pass` FROM `user` WHERE `user_login` LIKE '$loginn'")->fetch_array();

        $result = mysqli_query($link, "SELECT `user_pass` FROM `user` WHERE `user_login` LIKE '$loginn'");
        while ($row = $result->fetch_assoc()) {
            if ($_POST['password'] == $row['user_pass']) {
                $hashh = $_COOKIE["hash"];
                mysqli_query($link, "UPDATE `user` SET `user_hash`='$hashh' WHERE `user_login` LIKE '$loginn'");
                echo '<script> window.location.href = "lk.php"; </script>';
            }
        }
    }
    if (isset($_POST['reg'])) {
        echo '<script> window.location.href = "lk.php?register=1"; </script>';
    }

} elseif ($reg == "1") {

    echo ('<form method="POST">
    Имя <input name="username" type="text" required><br>
    Логин <input name="userlogin" type="text" required><br>
    Пароль <input name="userpassword" type="password" required><br>
    <input name="reg" type="submit" value="Регистрация">
    </form>
    <form method="POST">
    <input name="submitt" type="submit" value="Войти">
    </form>
    ');
    if (isset($_POST['username'])) {
        $usermane = $_POST['username'];
    }
    if (isset($_POST['userlogin'])) {
        $userlogin = $_POST['userlogin'];
    }
    if (isset($_POST['userpassword'])) {
        $userpassword = $_POST['userpassword'];
    }

    if (isset($_POST['reg'])) {
        mysqli_query($link, "INSERT INTO `user`(`user_name`, `user_pass`, `user_login`,`user_role`) VALUES ('$usermane','$userlogin','$userpassword','2')");
        $hashh = $_COOKIE["hash"];
        mysqli_query($link, "UPDATE `user` SET `user_hash`='$hashh' WHERE `user_login` LIKE '$userlogin'");
        echo '<script> window.location.href = "lk.php"; </script>';

    }
    if (isset($_POST['submitt'])) {
        echo '<script> window.location.href = "lk.php?register=0"; </script>';
    }
}


?>