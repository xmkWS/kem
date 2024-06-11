<?php
session_start();
require 'php/db.php'; // Подключение файла с базой данных, если необходимо

if (isset($_SESSION['id'])) {
  $currentUserId = $_SESSION['id'];
  $currentUserLogin = $_SESSION['login'];
  $currentUserPhoto = $_SESSION['photo'];
  $currentUserEmail = $_SESSION['email'];
  $currentUserRole = $_SESSION['idrole'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="./js/accordion.js" defer></script>
  <script src="./js/slider.js" defer></script>
  <script src="./js/drop-down-menu.js" defer></script>
  <script src="./js/burger.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <title>KEMII</title>
</head>

<body>

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/header.php') ?>

  <!-- INFO START -->

  <div class="info">
    <div class="info-content container">
      <div class="info-text">
        <h1 class="info-title">
          Незабываемые выходные <br>
          /Сезон весна - лето 2024 <span><a href="#mini">новое</a></span>
        </h1>
      </div>
      <img class="info__img" src="/img/main.png" alt="main">
    </div>
  </div>


  <!-- INFO END -->

  <!-- CATEGORIES START -->

  <div class="categories">
    <div class="container">
      <div class="categories-content" id="categories">
        <a href="catalog.php" class="presentation-title">
          Категории
        </a>
      </div>

      <div class="categories-cards">
        <a class="category-card" href="/catalog.php?product_type=сумки">
          <img class="category-card__img" src="./img/categories/jamper.png" alt="category_img">
          <div class="category-card__title-container">
            <p class="category-card__title">Куртки</p>
          </div>
        </a>
        <a class="category-card" href="/catalog.php?product_type=сумки">
          <img class="category-card__img" src="./img/categories/bag.jpg" alt="category_img">
          <div class="category-card__title-container">
            <p class="category-card__title">Сумки</p>
          </div>
        </a>
        <a class="category-card" href="/catalog.php?product_type=сумки">
          <img class="category-card__img" src="./img/categories/shirt.png" alt="category_img">
          <div class="category-card__title-container">
            <p class="category-card__title">Рубашки</p>
          </div>
        </a>
        <a class="category-card" href="/catalog.php?product_type=сумки">
          <img class="category-card__img" src="./img/categories/shoes.png" alt="category_img">
          <div class="category-card__title-container">
            <p class="category-card__title">Обувь</p>
          </div>
        </a>
      </div>

    </div>
  </div>
  </div>

  <!-- CATEGORIES END -->

  <!-- SLIDER START -->
  <section class="slider">
    <div class="slider__content container">
      <div class="slider__title-wrapper">
        <div class="swiper__title">
          <div class="swiper__title-container">
            <h2 class="swiper__title-text">Мы в мире моды<span class="fashion-title"></span></h2>
            <div class="swiper__title-highlight"></div>
          </div>
        </div>
      </div>
      <div class="swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="slider__text-container">
              <div class="slider__text__title-info">
                <h3 class="slider__text__title">
                  Fashion Forward: Paris Fall/Winter 2023
                </h3>
                <p class="slider__text__line"> | </p>
                <p class="slider__text__city-date">Париж, <span class="slider__text__date">сентябрь 2024</span></p>
              </div>
              <div class="slider__text__description">
                На этой выставке будут представлены последние коллекции от известных французских дизайнеров, отражающие новые тенденции и направления в мире высокой моды. Гости смогут увидеть роскошные платья, превосходные аксессуары и инновационные дизайны, которые станут трендами следующего сезона.
              </div>
            </div>
            <div style="max-width: 100%; overflow: hidden;" class="about__video">
              <iframe src="https://player.vimeo.com/video/361680538?autoplay=1&loop=1&title=0&byline=0&portrait=0&muted=1" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
              <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
            <!-- <img src="./img/slider/slide-1.webp" alt="slider-1"> -->
          </div>
          <div class="swiper-slide">
            <div class="slider__text-container">
              <div class="slider__text__title-info">
                <h3 class="slider__text__title">
                  Milan Fashion Week: Spring/Summer 2024
                </h3>
                <p class="slider__text__line"> | </p>
                <p class="slider__text__city-date">Милан, <span class="slider__text__date">февраль 2024</span></p>
              </div>
              <div class="slider__text__description">
                Эта выставка будет посвящена весенне-летним коллекциям итальянских дизайнеров. Гости смогут насладиться изысканными тканями, оригинальными кроями и яркими цветами, которые делают миланскую моду неповторимой и узнаваемой.
              </div>
            </div>
            <div style="max-width: 100%; overflow: hidden;" class="about__video">
              <iframe src="https://player.vimeo.com/video/361680475?autoplay=1&loop=1&title=0&byline=0&portrait=0&muted=1" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
              <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
            <!-- <img src="./img/slider/slide-2.jpeg" alt="slider-1"> -->
          </div>
          <div class="swiper-slide">
            <div class="slider__text-container">
              <div class="slider__text__title-info">
                <h3 class="slider__text__title">
                  New York Fashion Week: Fall 2023
                </h3>
                <p class="slider__text__line"> | </p>
                <p class="slider__text__city-date">Нью Йорк, <span class="slider__text__date">апрель 2023</span></p>
              </div>
              <div class="slider__text__description">
                На этой выставке будут представлены новые инновационные коллекции американских дизайнеров, отражающие дух современности и разнообразие стилей. Гости смогут увидеть дерзкие силуэты, эксперименты с текстурами и яркие графические узоры, которые сделают модную осень незабываемой.
              </div>
            </div>
            <div style="max-width: 100%; overflow: hidden;" class="about__video">
              <iframe src="https://player.vimeo.com/video/361547031?autoplay=1&loop=1&title=0&byline=0&portrait=0&muted=1" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
              <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
            <!-- <img src="./img/slider/slide-3.jpg" alt="slider-1"> -->
          </div>
        </div>
        <div class="swiper-pagination"></div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
  </section>

  <style>
    @media screen and (min-width: 1100px) {
      .slider__title-wrapper {
        height: 1px;
        top: 0;
        left: 0;
        position: relative;
      }

      .swiper__title {
        font-weight: 600;
        top: -7rem;
        left: 0;
        position: absolute;
        z-index: 10;
      }

      .swiper__title-container {
        position: relative;
      }

      .swiper__title-highlight {
        width: calc(1px + 100%);
        height: 65%;
        top: 50%;
        left: 0 ;
        background: #f89412;
        position: absolute;
      }

      .swiper__title-text {
        position: relative;
        z-index: 11;
        font-size: 6rem;
        color: #121212;
      }

      .fashion-title {
        font-weight: 400;
        /* font-family: "Yeseva One", serif; */
      }

      .slider__content {
        overflow: visible;
      }

      .slider {
        margin-top:  10rem;
      }

      .swiper {
        width: 100%;
      }

      .swiper-wrapper {
        margin-top: 20px;
      }

      .swiper-slide {
        overflow: hidden;
        width: 100%;
        aspect-ratio: 16/9;
        /* height: 25rem; */
        border-radius: 50px;
      }

      .swiper-slide img {
        height: 50rem;
        top: 0px;
        width: 100%;
        object-fit: cover;
      }

      .slider__text-container {
        z-index: 5;
        position: absolute;
        bottom: 0;
        left: 0;
        padding: 30px;
        padding-top: 50%;
        background: linear-gradient(#12121200, #12121280);
      }

      .slider__text__title-info {
        display: flex;
        align-items: center;
        gap: 15px;
      }

      .slider__text__title {
        color: #fff;
        font-size: 2.4rem;
      }

      .slider__text__line {
        color: #d8d8d8;
        font-size: 2rem;
      }

      .slider__text__city-date {
        color: #c4c4c4;
        font-size: 2rem;
      }

      .slider__text__date {
        color: #555555;
      }

      .slider__text__description {
        margin-top: 2rem;
        font-size: 1.2rem;
        color: #c5c5c5;
      }
    }

    @media screen and (max-width: 1099px) {
      .slider__title-wrapper {
        height: 1px;
        top: 0;
        left: 0;
        position: relative;
      }

      .swiper__title {
        font-weight: 600;
        top: -3rem;
        left: 0;
        position: absolute;
        z-index: 10;
      }

      .swiper__title-container {
        position: relative;
      }

      .swiper__title-highlight {
        width: calc(1px + 100%);
        height: 65%;
        top: 50%;
        left: 0;
        background: #f89412;
        position: absolute;
      }

      .swiper__title-text {
        position: relative;
        z-index: 11;
        font-size: 3rem;
        color: #121212;
      }

      .fashion-title {
        font-weight: 400;
        /* font-family: "Yeseva One", serif; */
      }

      .slider__content {
        overflow: visible;
      }

      .slider {
        margin-top: 5rem;
      }

      .swiper {
        width: 100%;
      }

      .swiper-wrapper {
        margin-top: 20px;
      }

      .swiper-slide {
        overflow: hidden;
        width: 100%;
        aspect-ratio: 16/9;
        /* height: 25rem; */
        border-radius: 20px;
      }

      .swiper-slide img {
        height: 50rem;
        top: 0px;
        width: 100%;
        object-fit: cover;
      }

      .slider__text-container {
        z-index: 5;
        position: absolute;
        bottom: 0;
        left: 0;
        padding: 1rem;
        padding-top: 50%;
        background: linear-gradient(#12121200, #12121260);
      }

      .slider__text__title-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
      }

      .slider__text__title {
        color: #fff;
        font-size: 1.1rem;
      }

      .slider__text__line {
        color: #d8d8d8;
        font-size: 1.4rem;
      }

      .slider__text__city-date {
        color: #c4c4c4;
        font-size: 0.9rem;
      }

      .slider__text__date {
        color: #555555;
      }

      .slider__text__description {
        margin-top: 1rem;
        font-size: 0.8rem;
        color: #c5c5c5;
      }
    }
  </style>
  <!-- SLIDER END -->

  <!-- NEWS START -->

  <div class="news">
    <div class="container">
      <div class="news-content" id="news">

        <div class="news-lines">

          <div class="accordion container">
            <div class="accordion-item">
              <div class="accordion-item-header">
                <span class="accordion-item-header-title">Какие у вас условия возврата?</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down accordion-item-header-icon">
                  <path d="m6 9 6 6 6-6" />
                </svg>
              </div>
              <div class="accordion-item-description-wrapper">
                <div class="accordion-item-description">
                  <!-- <hr> -->
                  <p>Мы предлагаем гарантию возврата денег в течение 14 дней с момента покупки. Товар должен быть в оригинальной упаковке и не должен быть носимым или поврежденным. Мы также обмениваем товары на другой размер или цвет, если это необходимо.</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <div class="accordion-item-header">
                <span class="accordion-item-header-title">Могу ли я узнать о новых поступлениях и акциях?</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down accordion-item-header-icon">
                  <path d="m6 9 6 6 6-6" />
                </svg>
              </div>
              <div class="accordion-item-description-wrapper">
                <div class="accordion-item-description">
                  <!-- <hr> -->
                  <p>Конечно! Вы можете подписаться на нашу рассылку или следить за нами в социальных сетях, чтобы узнавать первыми о новых поступлениях, акциях и специальных предложениях. Мы также регулярно обновляем наш каталог товаров, чтобы предложить вам самые актуальные тренды и коллекции.)</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <div class="accordion-item-header">
                <span class="accordion-item-header-title">Какие виды женской одежды вы предлагаете?</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down accordion-item-header-icon">
                  <path d="m6 9 6 6 6-6" />
                </svg>
              </div>
              <div class="accordion-item-description-wrapper">
                <div class="accordion-item-description">
                  <!-- <hr> -->
                  <p>Наша компания предлагает широкий ассортимент женской одежды, включая платья, блузы, брюки, юбки, кардиганы и многое другое. Мы также имеем разнообразие размеров, стилей и цветов, чтобы удовлетворить потребности каждой нашей клиентки.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- NEWS END -->

  <!-- FORM START -->

  <div class="form">
    <div class="container">
      <div class="form-content" id="form">
        <div class="form-text">
          <h1 class="form-title">
            ПРИСОЕДИНЯЙТЕСЬ К НАШЕЙ РАССЫЛКЕ НОВОСТЕЙ
          </h1>
          <form class="input-inner" method="post" action="php/add_request.php">
            <div>
              <input class="form-input" type="text" name="email" placeholder="Введите свой электронный адрес">
              <button type="submit" class="form-button mediabutton">Подписка</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- FORM END -->

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/components/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>