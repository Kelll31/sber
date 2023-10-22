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

<body>

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
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
              </li>
            </ul>
            <div class="quote_btn-container">
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
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Анализируй работу сотрудников
                    </h1>
                    <p>
                    Платформа для упрощения процесса мониторинга производительности сотрудников компании
                    </p>
                    <div class="btn-box">
                      <a href="lk.php" class="btn1">
                      Начать работу
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                    Анализируй работу сотрудников
                    </h1>
                    <p>
                    Платформа для упрощения процесса мониторинга производительности сотрудников компании
                    </p>
                    <div class="btn-box">
                      <a href="lk.php" class="btn1">
                        Начать работу
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                    Анализируй работу сотрудников
                    </h1>
                    <p>
                    Платформа для упрощения процесса мониторинга производительности сотрудников компании
                    </p>
                    <div class="btn-box">
                      <a href="lk.php" class="btn1">
                      Начать работу
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>

    </section>
    <!-- end slider section -->
  </div>

  <!-- service section -->
  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Наши Возможности
        </h2>
        <p>
          Кадровый Взгляд предоставляет своим пользователям обширный диапозон возможностей упростить жизнь
        </p>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="images/s1.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Связь
              </h5>
              <p>
                Быстро и удобно донести нужную информацию до подчинённых
              </p>
              <a href="">
                <span>
                  Подробнее
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="images/s2.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Статистика
              </h5>
              <p>
                Удобный просмотр величин производительности труда работников
              </p>
              <a href="">
                <span>
                  Подробнее
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="images/s3.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Уведомления
              </h5>
              <p>
                Приходят уведомления, облегчающие отслеживание объёма работы
              </p>
              <a href="">
                <span>
                  Подробнее 
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="images/s4.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Обратная связь
              </h5>
              <p>
                Информация от сотрудников отображена в ЛК руководителя 
              </p>
              <a href="">
                <span>
                  Подробнее
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-box">
        <a href="">
          Подробнее
        </a>
      </div>
    </div>
  </section>
  <!-- end service section -->

  <!-- О нас section -->

  <section class="about_section layout_padding">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                О нас
              </h2>
            </div>
            <p>
            Данная платформа позволяет сотруднику вносить данные о проделанной работе в рамках конкретной задачи, 
            отслеживать дедлайны и свой прогресс в соотношении с планом. В свою очередь руководитель может отслеживать 
            информацию по всем сотрудникам подконтрольной группы и получать статистику по работе группы в целом.  
            </p>
            <a href="">
              Подробнее
            </a>
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- end О нас section -->

  <!-- case section -->

  <section class="case_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Мы помогаем 
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="img-box">
              <img src="images/case-1.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Тяжело обрабатывать отчёты сотрудников?
              </h5>
              <p>
                Для этого у нас есть специальная программа, которая анализирует все данные ваших сотрудников  
              </p>
              <a href="">
                <span>
                  Подробнее
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box">
            <div class="img-box">
              <img src="images/case-2.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Тяжело донести до всех сотрудников нужную задачу?
              </h5>
              <p>
                Для этого у нас удобная рассылка. Все сотрудники увидят, какую именно задачу им нужно выполнять
              </p>
              <a href="">
                <span>
                  Подробнее
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end case section -->

  <!-- client section -->
  <section class="client_section ">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Обратная связь
        </h2>
      </div>
    </div>
    <div id="customCarousel2" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container">
            <div class="row">
              <div class="col-md-10 mx-auto">
                <div class="box">
                  <div class="img-box">
                    <img src="images/client.jpg" alt="">
                  </div>
                  <div class="detail-box">
                    <div class="client_info">
                      <div class="client_name">
                        <h5>
                          Билл Гейтс
                        </h5>
                        <h6>
                          Customer
                        </h6>
                      </div>
                      <i class="fa fa-quote-left" aria-hidden="true"></i>
                    </div>
                    <p>
                    Благодаря программе "Кадровый взгляд" моя команда смогла выпустить новую версию Windows 12 и почистить 150кг. мандаринов в 2 раза быстрее положенного срока
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row">
              <div class="col-md-10 mx-auto">
                <div class="box">
                  <div class="img-box">
                    <img src="images/client.jpg" alt="">
                  </div>
                  <div class="detail-box">
                    <div class="client_info">
                      <div class="client_name">
                        <h5>
                          Илон Маск
                        </h5>
                        <h6>
                          Customer
                        </h6>
                      </div>
                      <i class="fa fa-quote-left" aria-hidden="true"></i>
                    </div>
                    <p>
                    Огромное спасибо создателям программы "Кадровый взгляд", 
                    они помогли мне оптимизировать работу моих инженеров, отследить, 
                    что двое из них, вместо загрузки ракетного топлива, только играли в Доту 2. 
                    Благодаря их увольнению мы начали работать на 50% эффективнее
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row">
              <div class="col-md-10 mx-auto">
                <div class="box">
                  <div class="img-box">
                    <img src="images/client.jpg" alt="">
                  </div>
                  <div class="detail-box">
                    <div class="client_info">
                      <div class="client_name">
                        <h5>
                          Лил Гол
                        </h5>
                        <h6>
                          Customer
                        </h6>
                      </div>
                      <i class="fa fa-quote-left" aria-hidden="true"></i>
                    </div>
                    <p>
                      Я использовал программу Кадровый Взгляд, чтобы удобно доносить задачи до всех своих 15000000 сотрудников. Все успешно отчитались о её выполнении. Спасибо авторам. Они получает +15 социальный рейтинг и кошкожена
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <ol class="carousel-indicators">
        <li data-target="#customCarousel2" data-slide-to="0" class="active"></li>
        <li data-target="#customCarousel2" data-slide-to="1"></li>
        <li data-target="#customCarousel2" data-slide-to="2"></li>
      </ol>
    </div>
  </section>
  <!-- end client section -->



  <!-- contact section -->



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