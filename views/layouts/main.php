<?php

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="html" lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php $this->registerCsrfMetaTags() ?>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="format-detection" content="telephone=no">
  <meta property="og:type" content="website">
  <meta property="og:url" content="">
  <meta property="og:title" content="">
  <meta property="og:description" content="">
  <meta property="og:site_name" content="Главная">
  <meta property="og:locale" content="ru_RU">
  <title><?= Html::encode($this->title) ?></title>
  <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;amp;subset=cyrillic">
  <?php $this->head() ?>
</head>
<body class="body">
<?php $this->beginBody() ?>
<div class="page" id="page">
  <header class="page__header">
    <v-header inline-template>
      <div class="header">
        <div class="container">
          <div class="header__inner">
              <div class="header__logo">
                  <a class="logo" href="/" title="Главная страница"></a>
              </div>
            <div class="header__nav">
              <nav class="nav">
                <ul class="nav__list">
                  <li class="nav__item"><a class="nav__link" href="<?= \yii\helpers\Url::to(['/catalog/frontend/index']) ?>" title="Каталог">Каталог</a></li>
                  <li class="nav__item"><a class="nav__link" href="/portfolio.html" title="Портфолио">Портфолио</a></li>
                  <li class="nav__item"><a class="nav__link" href="/delivery.html" title="Доставка и оплата">Доставка и оплата</a></li>
                  <li class="nav__item"><a class="nav__link" href="/reviews.html" title="Отзывы">Отзывы</a></li>
                  <li class="nav__item"><a class="nav__link" href="/about.html" title="Компания">Компания</a></li>
                  <li class="nav__item"><a class="nav__link" href="<?= \yii\helpers\Url::to(['/actions/frontend/index']) ?>" title="Акции">Акции</a></li>
                </ul>
              </nav>
            </div>
            <nav class="phone">
              <ul class="phone__list">
                <li class="phone__item">
                  <p class="phone__number">+8 (800) 201 42 91</p>
                </li>
                <li class="phone__item">
                  <p class="phone__number">+8 (920) 338 91 69</p>
                </li>
                <li class="phone__item">
                  <p class="phone__number">510-110</p>
                </li>
              </ul>
            </nav>
            <button class="button js-button is-call" area-label="Заказать звонок" @click="show">Заказать звонок</button>
          </div>
        </div>
      </div>
    </v-header>
  </header>
  <main class="page__content">
    <?= $content ?>
  </main>
  <footer class="page__footer">
    <div class="footer">
      <div class="container">
        <div class="footer__inner">
          <div class="footer__copy">© 2020 Изготовление бань-бочек в Смоленске</div>
          <div class="footer__social"><img class="footer__image" src="img/social-1.svg" alt=""><img class="footer__image" src="img/social-2.svg" alt=""><img class="footer__image" src="img/social-3.svg" alt=""></div>
          <div class="footer__text"><a href="/policy.html" title="Политика конфиденциальности">Политика конфиденциальности</a><a href="https://dancecolor.ru/" title="Сделано в Dancecolor">Сделано в Dancecolor</a></div>
        </div>
      </div>
    </div>
  </footer>
  <modal name="order" height="auto" :width="370">
    <div class="modal__body">
      <div class="modal__content">
        <div class="modal__container">
          <p class="modal__title">Мы перезвоним</p><img class="modal__close" src="img/close.svg" alt="" @click="$modal.hide('order')">
        </div>
        <input class="modal__input" type="text" placeholder="Как вас зовут?">
        <input class="modal__input" type="text" placeholder="Ваш номер телефона"><a class="button js-button" area-label="Загрузить еще" href="/index.html">Загрузить еще</a>
      </div>
    </div>
  </modal>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
