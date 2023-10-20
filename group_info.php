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
                Добавить участника: <input name="text" type="textarea" value="Введите имя">
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


                echo (" Участники:    </br>");
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

        }

        $group_id_check = mysqli_query($link, "SELECT `group_slaves` FROM `groups` WHERE `group_slaves` LIKE '$id'");
        //  if ($group_id_check != $id) {
        //      echo $id;
        //     echo "Вы раб этой группы";
        // }
    }





}
?>