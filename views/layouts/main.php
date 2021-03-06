<?php

use app\assets\AppAsset;
use app\modules\page\components\Pages;
use app\modules\setting\components\Settings;
use app\widgets\BreadcrumbWidget;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/**
 * @var string $content
 */

AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="html" lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php $this->registerCsrfMetaTags() ?>
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
                  <li class="nav__item"><a class="nav__link" href="<?= \yii\helpers\Url::to(['/portfolio/frontend/index']) ?>">Портфолио</a></li>
                  <li class="nav__item"><a class="nav__link" href="<?= Pages::getHref('delivery') ?>" title="Доставка и оплата">Доставка и оплата</a></li>
                  <li class="nav__item"><a class="nav__link" href="<?= \yii\helpers\Url::to(['/review/frontend/index']) ?>" title="Отзывы">Отзывы</a></li>
                  <li class="nav__item"><a class="nav__link" href="<?= Pages::getHref('about') ?>" title="Компания">Компания</a></li>
                  <li class="nav__item"><a class="nav__link" href="<?= \yii\helpers\Url::to(['/actions/frontend/index']) ?>" title="Акции">Акции</a></li>
                </ul>
              </nav>
            </div>
            <nav class="phone">
              <ul class="phone__list">
                  <?php foreach (Settings::getArray('phones') as $phone): ?>
                      <li class="phone__item">
                          <p class="phone__number"><?= $phone ?></p>
                      </li>
                  <?php endforeach ?>
              </ul>
            </nav>
            <button class="button js-button is-call" area-label="Заказать звонок" @click="show">Заказать звонок</button>
          </div>
        </div>
      </div>
    </v-header>
  </header>
  <main class="page__content">

      <?php if (!empty($this->params['breadcrumbs'])): ?>
          <div class="container">
              <?= BreadcrumbWidget::widget(['links' => $this->params['breadcrumbs']]) ?>
          </div>
      <?php endif ?>

      <?php if (!empty($this->params['h1'])): ?>
          <div class="container">
              <h1 class="section__title"><?= Html::encode($this->params['h1']) ?></h1>
          </div>
      <?php endif ?>

    <?= $content ?>
  </main>
  <footer class="page__footer">
    <div class="footer">
      <div class="container">
        <div class="footer__inner">
          <div class="footer__copy">© 2020 Изготовление бань-бочек в Смоленске</div>
          <div class="footer__social">

              <?php if (Settings::getValue('odnoklassniki')): ?>
              <a href="<?= Settings::getValue('odnoklassniki') ?>" target="_blank"><img class="footer__image" src="/img/social-1.svg" alt=""></a>
              <?php endif ?>

              <?php if (Settings::getValue('facebook')): ?>
                  <a href="<?= Settings::getValue('facebook') ?>" target="_blank"><img class="footer__image" src="/img/social-2.svg" alt=""></a>
              <?php endif ?>

              <?php if (Settings::getValue('vk')): ?>
                  <a href="<?= Settings::getValue('vk') ?>" target="_blank"><img class="footer__image" src="/img/social-3.svg" alt=""></a>
              <?php endif ?>

          </div>
          <div class="footer__text">
              <a href="<?= Pages::getHref('policy') ?>" title="Политика конфиденциальности">Политика конфиденциальности</a>
              <a href="https://dancecolor.ru/" title="Сделано в Dancecolor">Сделано в Dancecolor</a></div>
        </div>
      </div>
    </div>
  </footer>
  <modal name="order" height="auto" :width="370">
    <div class="modal__body">
      <div class="modal__content">
        <div class="modal__container">
          <p class="modal__title">Мы перезвоним</p>
            <img class="modal__close" src="/img/close.svg" alt="" @click="$modal.hide('order')">
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
