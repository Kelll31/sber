<!DOCTYPE html>
<html lang="en">

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
                        </ul>
                        <div class="quote_btn-container ">
                            <a href="lk.php" class="quote_btn">
                                <?php
                                include 'main_script.php';
                                if (mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'")->fetch_array() != 0) {
                                    $checkcart2 = mysqli_query($link, "SELECT `user_count` FROM `user` WHERE `user_hash` LIKE '$hashh'");
                                    while ($checkcart1 = $checkcart2->fetch_assoc()) {
                                        $checkcart = $checkcart1["user_count"];
                                    }
                                    if (empty($checkcart)) {
                                        mysqli_query($link, "UPDATE `user` SET `user_count`=',' WHERE `user_hash` LIKE '$hashh'");
                                    }
                                    $user_id1 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'");
                                    while ($user_id2 = $user_id1->fetch_assoc()) {
                                        $user_id = $user_id2["user_id"];
                                    }

                                    $name = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_hash` LIKE '$hashh'");
                                    while ($row = $name->fetch_assoc()) {

                                        echo ("Лк " . $row['user_name'] . "</br>");
                                    }
                                } else {
                                    echo 'Вход';
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

    <!-- форма -->

    <section class="contact_section layout_padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 offset-md-1">
                    <div class="row">

                        <?php

                        if (!isset($_GET['id'])) {
                            echo '<script> window.location.href = "lk.php"; </script>';
                        } else {

                            $user_id = $_GET['id'];
                            $user_name2 = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_id` LIKE '$user_id'"); // имя
                            while ($user_name1 = $user_name2->fetch_assoc()) {
                                echo "<h2>Юзер " . $user_name1['user_name'] . "</h2>";
                                $user_name = $user_name1['user_name'];
                            }
                            echo "<h5> Группы в которых он участвует: </h5><dl>";

                            $group_name2 = mysqli_query($link, "SELECT `group_name` FROM `groups` WHERE `group_user_admin` LIKE '%$user_id%'"); //менеджер
                            while ($group_name1 = $group_name2->fetch_assoc()) {
                                $group_name = $group_name1['group_name'];
                                $group_id2 = mysqli_query($link, "SELECT `group_id` FROM `groups` WHERE `group_name` LIKE '$group_name'");
                                while ($group_id1 = $group_id2->fetch_assoc()) {
                                    $group_id = $group_id1['group_id'];
                                }

                                echo "<dt>Участник как менеджер - <a href='group_info.php?id=" . $group_id . "'>" . $group_name1['group_name'] . "</a></dt>";
                            }



                            $group_name2 = mysqli_query($link, "SELECT `group_name` FROM `groups` WHERE `group_slaves` LIKE '%$user_id%'"); //раб
                            while ($group_name1 = $group_name2->fetch_assoc()) {
                                $group_name = $group_name1['group_name'];

                                $group2 = mysqli_query($link, "SELECT `group_id`,`group_tasks` FROM `groups` WHERE `group_name` LIKE '$group_name'");
                                while ($group1 = $group2->fetch_assoc()) {
                                    $group_id = $group1['group_id']; //id группы 
                                    $group_tasks = $group1['group_tasks']; //задачи группы
                                    $group1['group_tasks'] = str_replace('[', ',', $group1['group_tasks']);
                                    $group1['group_tasks'] = str_replace(']', ',', $group1['group_tasks']);
                                    $group1['group_tasks'] = str_replace('0', ',', $group1['group_tasks']);
                                    $group1['group_tasks'] = str_replace('', ',,', $group1['group_tasks']);
                                    $group1['group_tasks'] = str_replace('=', ',', $group1['group_tasks']);
                                    $task_group_state = explode(",", $group1['group_tasks']);
                                    $task_group_count = count($task_group_state, true) - 1;
                                    //print_r($task_group_state);
                                    // echo "</br>";
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
                                    //print_r($task_group_count);
                                    $task_group_count = 0;
                                    while (-1 < $task_group_count) {
                                        if (in_array($task_group_state[$task_group_count], $task_user_state)) {


                                            $bubuq = [];
                                            foreach ($task_user_state as $key => $value) {
                                                if (empty($bubuq[$value])) {
                                                    $bubuq[$value] = 0;
                                                } else {
                                                }
                                                $bubuq[$value] = $bubuq[$value] + 1;

                                            }


                                            foreach ($bubuq as $key => $value) {
                                                // echo $key . "\t=>\t" . $value . "\n";
                        
                                                $task_name3 = mysqli_query($link, "SELECT `task_name` FROM `tasks` WHERE `task_id` LIKE '$key'");
                                                while ($task_name2 = $task_name3->fetch_assoc()) {
                                                    $task_name = $task_name2['task_name'];
                                                    echo "<dt>" . $task_name . "- выполнено " . $value . "    раз(a)  </dt>";
                                                }
                                            }


                                        }

                                        $task_group_count = $task_group_count - 1;
                                    }



                                }






                                echo "<dt>Участник как раб - <a href='group_info.php?id=" . $group_id . "'>" . $group_name1['group_name'] . "</a> </dt></br>";
                            }
                            echo "</dl>";

                        }
                        ?>





                    </div>
                </div>
                <div class="col-md-6 col-lg-7 px-0">
                    <div class="map_container">
                        <div class="map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1101.5457326423443!2d37.61734285342094!3d54.196125269795196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x41344152d3f2e80b%3A0xabf83791a029088d!2z0KHQsdC10YDQkdCw0L3Qug!5e0!3m2!1sru!2sru!4v1697942371334!5m2!1sru!2sru"
                                width="75%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end contact section -->

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
                                <a class="" href="">
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



    <script src="https://vk.com/js/api/openapi.js?169" type="text/javascript"></script>
    <script type="text/javascript">
        VK.init({
            apiId: ВАШ_API_ID
        });
    </script>










</body>

</html>