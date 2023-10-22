<!DOCTYPE html>
<html lang="en">

<?php
include 'main_script.php';
?>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Кадровый взгляд</title>


    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="index.php">
                        <span>
                            Кадровый взгляд
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ">
                            <li class="nav-item ">
                                <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">

                                <?php
                                if (isset($_GET['mode'])) {
                                    if ($_GET['mode'] == 0) {
                                        echo '<a class="nav-link" href="edit.php?mode=1"> Редактор груп (сменить)</a>';
                                    } else {
                                        echo '<a class="nav-link" href="edit.php?mode=0"> Редактор задач (сменить)</a>';
                                    }
                                }



                                ?>

                            </li>
                        </ul>
                        <div class="quote_btn-container">

                            <?php
                            $name = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_hash` LIKE '$hashh'");
                            while ($row = $name->fetch_assoc()) {

                                echo '
                                  
                                  <a href="lk.php " class="quote_btn">ЛК    ';
                                echo $row['user_name'] . "</a>";
                            }

                            ?>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>

    <!-- service section -->
    <section class="service_section layout_padding">
        <div class="container">
            <div class="heading_container">

                <?php

                $hashh = $_COOKIE["hash"];
                $name = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_hash` LIKE '$hashh'");
                while ($row = $name->fetch_assoc()) {

                    //echo ("Привет   " . $row['user_name'] . "</br>");
                }
                $user_id1 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'");
                while ($user_id2 = $user_id1->fetch_assoc()) {
                    $user_id = $user_id2["user_id"];
                }
                if (isset($_GET['mode'])) {
                } else {
                    echo '<script> window.location.href = "lk.php"; </script>';
                }
                //echo " <a href=lk.php > Мой профиль</a></br></br>";
                if ($_GET['mode'] == 0) { //режим создания группы
                    $user_id2 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'"); // имя юзеров
                    while ($user_id1 = $user_id2->fetch_assoc()) {
                        $user_id = $user_id1['user_id'];
                    }

                    echo "<h2>
                    Режим создания группы
                </h2>";

                    echo '
                    <dl>
                    <form method="POST">
                    <dt><input name="group_name" type="text" required placeholder="Название группы " style="
                    border: none;
                    border-bottom: 1px solid #000000;
                    background-color: transparent;
                    width: 100%;
                    height: 45px;
                    color: #000000;
                    outline: none;
                "></dt>
                    <dt><input name="group_text" type="text" required placeholder="Описание группы " style="
                    border: none;
                    border-bottom: 1px solid #000000;
                    background-color: transparent;
                    width: 100%;
                    height: 45px;
                    color: #000000;
                    outline: none;
                "></dt>
                    <dt><input name="group_tasks" type="text" required placeholder="задачи группы (id)" style="
                    border: none;
                    border-bottom: 1px solid #000000;
                    background-color: transparent;
                    width: 100%;
                    height: 45px;
                    color: #000000;
                    outline: none;
                "></dt>
                    <dt></br><input name="submitt" type="submit" value="создать"style="
                    display: inline-block;
                    padding: 10px 45px;
                    background-color: #7335b7;
                    color: #ffffff;
                    border-radius: 5px;
                    -webkit-transition: all 0.3s;
                    transition: all 0.3s;
                    border: 1px solid #7335b7;
                "></dt>
                    </form>
                    </dl>';

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
                    echo "<h2>
                    Режим создания задачи
                </h2>";

                    echo '<form method="POST">
                    <dl>
                    <dt><input name="task_name" type="text" required placeholder="Название задачи" style="
                    border: none;
                    border-bottom: 1px solid #000000;
                    background-color: transparent;
                    width: 100%;
                    height: 45px;
                    color: #000000;
                    outline: none;
                "></dt>
                    <dt><input name="task_goal" type="text" required placeholder="Необходимое количество" style="
                    border: none;
                    border-bottom: 1px solid #000000;
                    background-color: transparent;
                    width: 100%;
                    height: 45px;
                    color: #000000;
                    outline: none;
                "></dt>
                    <dt><input name="task_time" type="date" required placeholder="Выполнить до" style="
                    border: none;
                    border-bottom: 1px solid #000000;
                    background-color: transparent;
                    width: 100%;
                    height: 45px;
                    color: #000000;
                    outline: none;
                "></dt>
                    <dt></br><input name="submitt" type="submit" value="создать"style="
                    display: inline-block;
                    padding: 10px 45px;
                    background-color: #7335b7;
                    color: #ffffff;
                    border-radius: 5px;
                    -webkit-transition: all 0.3s;
                    transition: all 0.3s;
                    border: 1px solid #7335b7;">
                    </dt>
                    </dl>
                    </form>
                    <h5>Редактирование ваших задач: </h5></br> <dl>';

                    $task2 = mysqli_query($link, "SELECT `task_name`,`task_goal`,`task_time` FROM `tasks` WHERE `task_user_admin` LIKE '$user_id'");
                    while ($task1 = $task2->fetch_assoc()) {
                        $task_name = $task1['task_name'];
                        $task_goal = $task1['task_goal'];
                        $task_time = $task1['task_time'];
                        $i = count($task1, true) - 1;

                        $task_id2 = mysqli_query($link, " SELECT `task_id` FROM `tasks` WHERE `task_name` LIKE '$task_name'");
                        while ($task_id1 = $task_id2->fetch_assoc()) {
                            $task_id = $task_id1['task_id'];

                            echo " <dt><a href=edit.php?mode=1&id=" . $task_id . " > " . $task_name . "</a></dt>";
                        }


                        $i = $i - 1;



                    }
                    echo '</dl> </br>';
                    if (!isset($_GET["id"])) {
                    } else {
                        $task_id_select = $_GET["id"];

                        $task_name2 = mysqli_query($link, "SELECT `task_name`,`task_goal`,`task_time` FROM `tasks` WHERE `task_id` LIKE '$task_id_select'");
                        while ($task_name1 = $task_name2->fetch_assoc()) {
                            $task_name = $task_name1['task_name'];
                            $task_goal = $task_name1['task_goal'];
                            $task_time = $task_name1['task_time'];


                            echo '
               
                <form method="POST">
                <dl><dt>
                    <input name="task_name_edit" type="text" value="' . $task_name . '" placeholder="Название задачи" style="
                    border: none;
                    border-bottom: 1px solid #000000;
                    background-color: transparent;
                    width: 100%;
                    height: 45px;
                    color: #000000;
                    outline: none;
                "></dt><dt>
                    <input name="task_goal_edit" type="text" value="' . $task_goal . '" placeholder="Необходимое количество" style="
                    border: none;
                    border-bottom: 1px solid #000000;
                    background-color: transparent;
                    width: 100%;
                    height: 45px;
                    color: #000000;
                    outline: none;
                "></dt><dt>
                    <input name="task_time_edit" type="date" value="' . $task_time . '" placeholder="Выполнить до" style="
                    border: none;
                    border-bottom: 1px solid #000000;
                    background-color: transparent;
                    width: 100%;
                    height: 45px;
                    color: #000000;
                    outline: none;
                "></dt><dt></br>
                    <input name="submitt_edit" type="submit" value="редактировать"style="
                    display: inline-block;
                    padding: 10px 45px;
                    background-color: #7335b7;
                    color: #ffffff;
                    border-radius: 5px;
                    -webkit-transition: all 0.3s;
                    transition: all 0.3s;
                    border: 1px solid #7335b7;">
                    </dt>
                    </dl>
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



            </div>

        </div>
    </section>
    <!-- end service section -->


    <div class="footer_container">
        <!-- info section -->

        <section class="info_section ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 ">
                        <div class="info_detail">
                            <h4>
                                Кадровый взгляд
                            </h4>
                            <p>
                                Платформа для упрощения процесса мониторинга производительности сотрудников компании
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 mx-auto">
                        <div class="info_link_box">
                            <h4>
                                Ссылки
                            </h4>
                            <div class="info_links">
                                <a class="" href="index.php">
                                    Главная
                                </a>
                                <a class="" href="about.php">
                                    О нас
                                </a>
                                <a class="" href="service.php">
                                    Сервис
                                </a>
                                <a class="" href="contact.php">
                                    Свяжитесь с нами
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 ">
                        <h4>
                            Подписаться
                        </h4>
                        <form action="#">
                            <input type="text" placeholder="Введите почту" />
                            <button type="submit">
                                Подписаться
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-0 ml-auto">
                        <div class="info_contact">
                            <h4>
                                Контакты
                            </h4>
                            <div class="contact_link_box">
                                <a href="">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>
                                        Расположение
                                    </span>
                                </a>
                                <a href="">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>
                                        Звоните +7 9549597654
                                    </span>
                                </a>
                                <a href="">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>
                                        cadreye@gmail.com
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- end info section -->

        <!-- footer section -->
        <footer class="footer_section">
            <div class="container">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved By
                    <a href="https://adrenalinerush.ru">Adrenaline</a>
                </p>
            </div>
        </footer>
        <!-- footer section -->
    </div>

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
    <!-- Google Map -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
    <!-- End Google Map -->

</body>

</html>