<?php
if (!empty($_SESSION['alert'])) {
  echo "<script>alert('" . $_SESSION['alert'] . "')</script>";
  unset($_SESSION['alert']);
}
if (!empty($_SESSION['fake_payment_response'])) {
  echo "<script>console.log('" . $_SESSION['fake_payment_response'] . "')</script>";
  unset($_SESSION['fake_payment_response']);
}
?>

<!-- SLIDER UP START -->

<a href="#" class="slider-up">
  <img src="./img/slider-up.svg" alt="" class="slider-up-inner">
</a>

<!-- SLIDER UP END -->

<!-- BURGER START -->

<div class="burger-menu">
  <ul class="menu">
    <li><a class="menuItem" href="index.php">Главная</a></li>
    <li><a class="menuItem" href="catalog.php">Каталог</a></li>

    <?php if (!isset($_COOKIE["user"]) || !isset($_SESSION['id']) || $currentUserRole != 2) : ?>
      <li><a class="menuItem" href="index.php">О нас</a></li>
      <li><a class="menuItem" href="index.php">Новости</a></li>
    <?php endif; ?>

    <?php if (!isset($_COOKIE["user"]) || !isset($_SESSION['id'])) : ?>
      <!-- Пользователь не авторизован -->
      <li><a class="menuItem" href="sign-in.php">Вход</a></li>
      <li><a class="menuItem" href="sign-up.php">Регистрация</a></li>
    <?php else : ?>
      <?php if ($currentUserRole == 1) : ?>
        <li class="fav-cart">
          <a class="menuItem" href="profile.php?tab=корзина">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
              <path fill="currentColor" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2" />
            </svg>
          </a>
          <a class="menuItem" href="/favorites.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
              <path fill="currentColor" d="M24.132 7.97c-2.203-2.204-5.916-2.097-8.25.236l-.382.382l-.382-.382c-2.334-2.333-6.047-2.44-8.25-.235c-2.204 2.204-2.098 5.917.235 8.25l8.396 8.396l8.395-8.396c2.334-2.333 2.44-6.046.237-8.25z" />
            </svg>
          </a>
        </li>
        <li><a class="menuItem" href="profile.php">Профиль</a></li>
      <?php elseif ($currentUserRole == 2) : ?>
        <li><a class="menuItem" href="admin.php?tab=заказы">Админ-панель</a></li>
      <?php endif; ?>
      <li><a class="menuItem" href="/php/logout.php">Выйти</a></li>
    <?php endif; ?>
  </ul>
  <button class="hamburger" onclick="this.classList.toggle('opened');
        this.setAttribute('aria-expanded', 
        this.classList.contains('opened'))" aria-label="Main Menu">
    <svg class="hb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" stroke="#000" stroke-width=".6" fill="rgba(0,0,0,0)" stroke-linecap="round" style="cursor: pointer">
      <path d="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7">
        <animate dur="0.2s" attributeName="d" values="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7;M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7" fill="freeze" begin="start.begin" />
        <animate dur="0.2s" attributeName="d" values="M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7;M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7" fill="freeze" begin="reverse.begin" />
      </path>
      <rect width="10" height="10" stroke="none">
        <animate dur="2s" id="reverse" attributeName="width" begin="click" />
      </rect>
      <rect width="10" height="10" stroke="none">
        <animate dur="0.001s" id="start" attributeName="width" values="10;0" fill="freeze" begin="click" />
        <animate dur="0.001s" attributeName="width" values="0;10" fill="freeze" begin="reverse.begin" />
      </rect>
    </svg>
  </button>
</div>


<!-- BURGER END -->

<!-- HEADER START -->

<header>
  <div class="container">
    <div class="header">
      <div class="header-content">
        <div class="header-menu">
          <a href="index.php">
            <img src="./img/logo.png" alt="Kemii" class="logo-header">
          </a>

          <ul class="header-menu">
            <li class="header-menu-item">
              <a href="catalog.php" class="header-link">
                Каталог
              </a>
              <ul class="sub-menu">
                <a href="index.php" class="sub-menu-item">
                  Категории
                </a>
                <a href="index.php" class="sub-menu-item">
                  Наше избранное
                </a>
              </ul>
            </li>
            <?php if (!isset($_COOKIE["user"]) || !isset($_SESSION['id']) || $currentUserRole != 2) : ?>
              <li class="header-menu-item">
                <a href="index.php" class="header-link">
                  О нас
                </a>
                <ul class="sub-menu">
                  <a href="index.php" class="sub-menu-item">
                    Кто мы?
                  </a>
                  <a href="index.php" class="sub-menu-item">
                    Мне нужна помощь
                  </a>
                </ul>
              </li>
              <li class="header-menu-item">
                <a href="index.php" class="header-link">
                  Новости
                </a>
                <ul class="sub-menu">
                  <a href="index.php" class="sub-menu-item">
                    Рассылка
                  </a>
                  <a href="index.php" class="sub-menu-item">
                    Важные новости
                  </a>
                </ul>
              </li>
            <?php endif; ?>
            <ul class="header-login">
              <?php if (!isset($_COOKIE["user"]) || !isset($_SESSION['id'])) : ?>
                <li class="sign-in">
                  <a href="sign-in.php">Вход</a>
                </li>
                <li class="sign-up">
                  <a href="sign-up.php">Регистрация</a>
                </li>
              <?php else : ?>
                <?php if ($currentUserRole == 1) : ?>
                  <li class="sign-up">
                    <a href="profile.php?tab=корзина">
                      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2" />
                      </svg>
                    </a>
                  </li>
                  <li class="sign-up">
                    <a href="/favorites.php">
                      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.27 2 8.5C2 5.41 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.41 22 8.5c0 3.77-3.4 6.86-8.55 11.53z" />
                      </svg>
                    </a>
                  </li>
                  <li class="sign-up">
                    <a href="profile.php">Профиль</a>
                  </li>
                <?php elseif ($currentUserRole == 2) : ?>
                  <li class="sign-up">
                    <a href="admin.php?tab=заказы">Админ-панель</a>
                  </li>
                <?php endif; ?>
                <li class="sign-up">
                  <a href="/php/logout.php">Выход</a>
                </li>
              <?php endif; ?>
            </ul>

        </div>
      </div>
    </div>
  </div>
</header>

<!-- HEADER END -->