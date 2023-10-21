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
            // Страница регистрации нового пользователя
            

            $hashh = $_COOKIE["hash"];
            $reg = $_GET['register'];
            if (!isset($_GET['register'])) {
              echo '<script> window.location.href = "lk.php?register=0"; </script>';
            }


            if (isset($_GET['uid'])) {
              $first_name = $_GET['first_name'];
              $last_name = $_GET['last_name'];
              $user_vk_name = $first_name . '   ' . $last_name;
              $uid = $_GET['uid'];
              echo '<div class="heading_container"> привет' . $first_name . '</div>';
              echo $uid;

              if (mysqli_query($link, "SELECT `user_login` FROM `user` WHERE `user_login` = '$uid'")->fetch_array() != 0) {
                mysqli_query($link, "UPDATE `user` SET `user_hash`='$hashh' WHERE `user_login` LIKE '$uid'");
                echo '<script> window.location.href = "lk.php"; </script>';

              } else {
                mysqli_query($link, "INSERT INTO `user`(`user_name`, `user_pass`, `user_login`,`user_role`) VALUES ('$user_vk_name','$uid','$uid','2')");
                $hashh = $_COOKIE["hash"];
                mysqli_query($link, "UPDATE `user` SET `user_hash`='$hashh' WHERE `user_login` LIKE '$uid'");
                echo '<script> window.location.href = "lk.php"; </script>';
              }




            }
            ?>



            <?php

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

                echo ("<dl>
                <dt> Привет   " . $row['user_name'] . "</dt> ");
              }
              $role2 = mysqli_query($link, "SELECT `user_role` FROM `user` WHERE `user_hash` LIKE '$hashh'");
              while ($role1 = $role2->fetch_assoc()) {
                $role = $role1['user_role'];
              }


              if ($role == "0") { // Права доступа    админ
                echo ("Права доступа    админ   ");


              } else if ($role == "1") { // Права доступа    менеджер групп
            
                echo '
                
 

  <dt><a class href=edit.php?mode=0 ><button > создать группу </button></a></dt>
  <dt><a class href=edit.php?mode=1 ><button href=edit.php?mode=1">создать задачу</button></a></dt>
              
              ';
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
            

                    echo ("<dt>Права доступа:    менеджер  -    </dt><dt> <a href='group_info.php?id=" . $group_id . "'>Группа " . $group_name . "</a></dt> <dt>участники:    </dt> ");
                    while (-1 < $i) {
                      $result = mysqli_query($link, "SELECT `user_name` FROM `user` WHERE `user_id` LIKE '$cart[$i]'"); // имя юзеров
                      while ($row = $result->fetch_assoc()) {
                        echo "<dt><a href='user_info.php?id=" . $cart[$i] . "'>" . $row['user_name'] . "</a> </dt>  ";
                      }
                      $i = $i - 1;
                    }
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
              echo ('
              <dt>         
              <form method="POST">
              <button name="exit" type="submit">Выйти</button>
              </form>
              </dt>');

              if (isset($_POST['exit'])) {
                mysqli_query($link, "UPDATE `user` SET `user_hash`='0' WHERE `user_hash` LIKE '$hashh'");
                echo '<script> window.location.href = "lk.php"; </script>';
              }


              // header('Location: http://localhost/sber/main.php');
//   header('refresh: 0');
            } else {

              if ($reg == "0") {
                echo ('
  <form method="POST">
  <div>
    <input name="loginn" type="text" required placeholder="Логин" />
  </div>
  <div>
    <input name="password" type="password" required placeholder="Пароль" />
  </div>
  <div class="d-flex ">
    <input name="submitt" type="submit" value="Войти">
  </div>
</form>
<form method="POST">
  <input name="reg" type="submit" value="Вход\регистрация">
</form>
</div>


<div id="vk_auth"></div>
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?168" charset="windows-1251"></script>
<script type="text/javascript">
VK.init({ apiId: 51775850 });
</script>

<div id="vk_auth"></div>
<script type="text/javascript">
VK.Widgets.Auth("vk_auth", { authUrl: "lk.php" });
</script>
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

              }
              if ($reg == "1") {

                echo ('<form method="POST">
              
  Имя <input name="username" type="text" required>
  </div>
  Логин <input name="userlogin" type="text" required><br>
  Пароль <input name="userpassword" type="password" required><br>
  <input name="reg" type="submit" value="Регистрация">
  </form>
  <form method="POST">
  <input name="submitt" type="submit" value="Вход\регистрация ">
  </form>

  <div id="vk_auth"></div>
  <script type="text/javascript" src="https://vk.com/js/api/openapi.js?168" charset="windows-1251"></script>
  <script type="text/javascript">
      VK.init({ apiId: 51775850 });
  </script>

  <div id="vk_auth"></div>
  <script type="text/javascript">
      VK.Widgets.Auth("vk_auth", { authUrl: "lk.php" });
  </script>
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
            }
            ?>

            </dl>

          </div>
        </div>
        <div class="col-md-6 col-lg-7 px-0">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
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
                Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin
                words, combined with a handful
              </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-2 mx-auto">
            <div class="info_link_box">
              <h4>
                Links
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
                  Contact Us
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 ">
            <h4>
              Subscribe
            </h4>
            <form action="#">
              <input type="text" placeholder="Enter email" />
              <button type="submit">
                Subscribe
              </button>
            </form>
          </div>
          <div class="col-md-6 col-lg-3 mb-0 ml-auto">
            <div class="info_contact">
              <h4>
                Address
              </h4>
              <div class="contact_link_box">
                <a href="">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <span>
                    Location
                  </span>
                </a>
                <a href="">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span>
                    Call +01 1234567890
                  </span>
                </a>
                <a href="">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <span>
                    demo@gmail.com
                  </span>
                </a>
              </div>
            </div>
            <div class="info_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
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
          <a href="https://html.design/">Free Html Templates</a>
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