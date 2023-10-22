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

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item ">
                <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">

                <?php
                echo '<a class="nav-link" href="group_info.php?id=' . $_GET['id'] . '"> О группе</a>';



                ?>


              </li>
            </ul>
            <div class="quote_btn-container">
              <a href="lk.php" class="quote_btn">
                Личный кабинет
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- О нас section -->

  <section class="about_section layout_padding layout_margin">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <p>

                <?php
                include 'main_script.php';


                if (!isset($_GET['id'])) {
                  echo '<script> window.location.href = "lk.php"; </script>';
                } else {



                  $name = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_hash` LIKE '$hashh'");
                  while ($row = $name->fetch_assoc()) {

                    //echo ("Привет   " . $row['user_name'] . "</br></br>");
                  }

                  $user_logined_id2 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'");
                  while ($user_logined_id1 = $user_logined_id2->fetch_assoc()) {
                    $user_logined_id = $user_logined_id1['user_id'];
                  }

                  $id = $_GET['id'];
                  $group_id2 = mysqli_query($link, "SELECT `group_name`,`group_text` FROM `groups` WHERE `group_id` LIKE '$id'"); // имя
                  while ($group_id1 = $group_id2->fetch_assoc()) {
                    $group_id = $group_id1["group_name"];
                    $group_text = $group_id1["group_text"];
                    echo "<h4>Группа - " . $group_id1['group_name'] . "</h4><p>" . $group_text . "</p>";
                  }



                  $group_user_admin2 = mysqli_query($link, "SELECT `group_user_admin` FROM `groups` WHERE `group_id` LIKE '$id'");
                  while ($group_user_admin1 = $group_user_admin2->fetch_assoc()) {

                    $user_id1 = mysqli_query($link, "SELECT `user_id` FROM `user` WHERE `user_hash` LIKE '$hashh'");
                    while ($user_id2 = $user_id1->fetch_assoc()) {
                      $user_id = $user_id2["user_id"];
                    }

                    $group_user_admin = $group_user_admin1['group_user_admin'];
                    if ($group_user_admin == $user_id) {
                      echo "<h6>доступ менеджера</h6>";



                      $group_slaves2 = mysqli_query($link, "SELECT `group_slaves` FROM `groups` WHERE `group_id` LIKE '$id'");
                      while ($group_slaves1 = $group_slaves2->fetch_assoc()) {
                        $group_slaves1['group_slaves'] = str_replace('[', ',', $group_slaves1['group_slaves']);
                        $group_slaves1['group_slaves'] = str_replace(']', ',', $group_slaves1['group_slaves']);
                        $group_slaves1['group_slaves'] = str_replace('0', ',', $group_slaves1['group_slaves']);
                        $group_slaves1['group_slaves'] = str_replace('', ',,', $group_slaves1['group_slaves']);
                        $cart = explode(",", $group_slaves1['group_slaves']);


                        echo ('
                        <div class="info_section form input" style="
                        width: -webkit-fill-available;
                    ">
                        <form method="POST" > 
                <input name="text" type="text" placeholder="Добавить участника (имя)"> 
                </form>
                <form method="POST">
                <input name="task_add" type="textarea" placeholder="Добавить задачу (название)">
                </form>
                </div>');

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










                        echo ("<p>Задачи:   </p>");


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

                            echo '<p><h3>' . $task_name1['task_name'] . '.</h3> </br>   Необходимое количество выполнений - ' . $task_goal . '.</br> Крайнее время выполнения задачи  ' . $task_time;
                            echo "</p>Приступившие к выполнению:    ";



                            $task_user_state3 = mysqli_query($link, "SELECT `user_name`,`user_count` FROM `user` WHERE `user_count` LIKE '%$group_tasks[$group_tasks_count]%'");
                            while ($task_user_state2 = $task_user_state3->fetch_assoc()) {
                              $suma[$group_tasks_count] = 0;
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
                                  $suma[$group_tasks_count] = $suma[$group_tasks_count] + 1;
                                }

                                $task_user_state_count = $task_user_state_count - 1;
                              }
                              echo $suma[$group_tasks_count] . '  выполнений';





                            }





                            echo '
                            <form method="POST" >
                        
                       <a> <button name="delete_task' . $group_tasks_count . '" type="submit" value="удалить задачу" style=    " width: 100%;
                        text-align: center;
                        display: contents;
                        padding: 10px 55px;
                        background-color: #f8842b;
                        color: #ffffff;
                        border-radius: 0;
                        -webkit-transition: all 0.3s;
                        transition: all 0.3s;
                        border: 1px solid #f8842b;
                        margin-top: 15px;">

                        Удалить задачу</button></a>
                        </form>
                        ';
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
                        echo ("</br> Участники:  <dl> <dt>  ");
                        while (-1 < $i) {
                          $result = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_id` LIKE '$cart[$i]'"); // имя юзеров
                          while ($row = $result->fetch_assoc()) {
                            echo '<form method="POST" >';
                            echo "<dt>  <a href='user_info.php?id=" . $cart[$i] . "'>" . $row['user_name'] . "</a>";
                            echo '
                            
                       <a> <button name="delete' . $i . '" type="submit" value="&#10008;" style=    " width: 100%;
                        text-align: center;
                        display: contents;
                        padding: 10px 55px;
                        background-color: #f8842b;
                        color: #ffffff;
                        border-radius: 0;
                        -webkit-transition: all 0.3s;
                        transition: all 0.3s;
                        border: 1px solid #f8842b;
                        margin-top: 15px;">
                        &#10008;</button></a>
                        </form>
                        </dt>  </dl>
                        ';
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

                            echo $suma . '  выполнений';

                          }


                          $slave2 = mysqli_query($link, "SELECT `group_slaves`	 FROM `groups` WHERE `group_id` LIKE '$id'");
                          while ($slave1 = $slave2->fetch_assoc()) {
                            $slave1['group_slaves'] = str_replace('[', ',', $slave1['group_slaves']);
                            $slave1['group_slaves'] = str_replace(']', ',', $slave1['group_slaves']);
                            $slave1['group_slaves'] = str_replace('0', ',', $slave1['group_slaves']);
                            $slave1['group_slaves'] = str_replace('', ',,', $slave1['group_slaves']);
                            $slave1['group_slaves'] = str_replace('=', ',', $slave1['group_slaves']);
                            $slave = explode(",", $slave1['group_slaves']);
                            if (in_array($user_id, $slave)) {


                              echo '<form method="POST">
                                    <input name="adddd' . $group_tasks[$group_tasks_count] . '" type="submit" value="Выполнил">
                                    </form>';

                              //print_r($task_user_state);
                             // echo $group_tasks[$group_tasks_count];
                              $push = $group_tasks[$group_tasks_count];

                              
                              if (!isset($_POST['adddd' . $push . ''])) {
                              } else {

                                array_push($task_user_state, $push);
                                sort($task_user_state);
                                $carttsasad = implode(",", $task_user_state);
                                mysqli_query($link, "UPDATE `user` SET `user_count`='$carttsasad' WHERE `user_id` LIKE '$user_logined_id'");
                                echo '<script> window.location.href = "group_info.php?id=' . $id . '"; </script>';
                              }





                            } else {
                              echo '</br>У вас нет прав к выполнению задачи</br>';
                            }

                          }


                        }
                        $group_tasks_count = $group_tasks_count - 1;

                      }
                    }

                  }





                }
                ?>
            </div>

          </div>
        </div>
        <?php

        $admin2 = mysqli_query($link, "SELECT `group_user_admin` FROM `groups` WHERE `group_id` LIKE '$id'");
        while ($admin1 = $admin2->fetch_assoc()) {
          if (!isset($admin1['group_user_admin'])) {
          } else {
            if ($group_user_admin == $user_id) {

              sort($suma);
              $coc = count($suma);
              //print_r($suma); 
        
            }
          }
        }



        ?>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load("current", { packages: ["corechart"] });
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([

              ['Task', 'Hours per Day'],
              <?php
              if ($group_user_admin == $user_id) {
                for ($i = 0; $i < $coc; $i++) {

                  echo "
                    ['Задача $i', $suma[$i]],";

                }

              } else {
                echo "
                ['Отсутствие прав доступа', 1],";
              }





              ?>

            ]);

            var options = {
              title: 'Продуктивность ',
              is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);   }
        </script>
        <div class="col-md-6 ">




          <div class="img-box">
            <div id="piechart_3d" style="width: 100%; height: 500px; backgroundColor.fill: none"></div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- end О нас section -->

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

</body>

</html>