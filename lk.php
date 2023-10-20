<?php
// Страница регистрации нового пользователя

include 'main_script.php';

$hashh = $_COOKIE["hash"];

if (mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'")->fetch_array() != 0) {

    $name = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_hash` LIKE '$hashh'");
    while ($row = $name->fetch_assoc()) {
        echo ("Привет   " . $row['user_name'] . "</br>");
        $role = mysqli_query($link, "SELECT `user_role` FROM `user` WHERE `user_hash` LIKE '$hashh'");
        while ($row = $role->fetch_assoc()) {
            if ($row['user_role'] == "0") {
                echo ("Права доступа    админ   </br>");
            } else if ($row['user_role'] == "1") {
                echo ("Права доступа    менеджер групп   </br>");
            } else if ($row['user_role'] == "2") {
                echo ("Права доступа раб    </br>");
            }
            echo ('<form method="POST">
    <input name="exit" type="submit" value="выйти">
    </form>');

            if (isset($_POST['exit'])) {
                mysqli_query($link, "UPDATE `user` SET `user_hash`='0' WHERE `user_hash` LIKE '$hashh'");
                echo '<script> window.location.href = "lk.php"; </script>';
            }
        }
    }
    // header('Location: http://localhost/sber/main.php');
    //   header('refresh: 0');
} else {
    echo ('<form method="POST">
Логин <input name="loginn" type="text" required><br>
Пароль <input name="password" type="password" required><br>
<input name="submitt" type="submit" value="войти">
</form>');
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

}

?>