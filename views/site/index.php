<?php


use app\modules\actions\widgets\RelevantActionsWidget;
use app\modules\admin\helpers\YoutubeHelper;
use app\modules\catalog\widgets\PopularProductsWidget;
use app\modules\faq\widgets\FaqWidget;
use app\modules\page\components\Pages;
use app\modules\review\widgets\ReviewsSliderWidget;
use app\modules\setting\components\Settings;
use app\modules\slide\widgets\SliderWidget;

/**
 * @var $this yii\web\View
 * @var \app\controllers\SiteController[] $slides
 */

Pages::getCurrentPage()->generateMetaTags();

?>

<?= SliderWidget::widget() ?>

<section class="section">
    <div class="container">
        <header class="section__header">
            <h2 class="section__title">Преимущества</h2>
        </header>
        <div class="section__body">
            <div class="advantages">
                <div class="advantages__section">
                    <div class="advantages__item"><img class="advantages__image" src="img/advantage-1.svg" alt="">
                        <p class="advantages__text">Быстрый прогрев и сохранение тепла</p>
                    </div>
                    <div class="advantages__item"><img class="advantages__image" src="img/advantage-2.svg" alt="">
                        <p class="advantages__text">Компактность <br> и эстетичность </p>
                    </div>
                    <div class="advantages__item"><img class="advantages__image" src="img/advantage-3.svg" alt="">
                        <p class="advantages__text">Мобильность <br> и транспортировка</p>
                    </div>
                    <div class="advantages__item"><img class="advantages__image" src="img/advantage-4.svg" alt="">
                        <p class="advantages__text">Быстрая установка </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= PopularProductsWidget::widget() ?>
<?= RelevantActionsWidget::widget() ?>
<section class="section is-alt">
    <div class="container">
        <div class="section__body">
            <div class="video">
                <p class="video__headline">Что входит в установку “под ключ”</p>
                <div class="grid is-row">
                    <div class="col-3">
                        <div class="video__container"><img class="video__circle" src="img/option-1.svg" alt="">
                            <p class="video__text">Доставка по Смоленской обл. <br> и России</p>
                        </div>
                        <div class="video__container"><img class="video__circle" src="img/option-3.svg" alt="">
                            <p class="video__text">Установка с помощью крана-манипулятора</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="video__cover">
                            <?php if ($youtubeImg = YoutubeHelper::previewImage(Settings::getValue('video'))): ?>
                                <img class="video__image" src="<?= $youtubeImg ?>" alt="">
                            <?php else: ?>
                                <img class="video__image" src="/img/video.jpg" alt="">
                            <?php endif ?>
                            <?php if ($videoSrc = YoutubeHelper::url(Settings::getValue('video'))): ?>
                                <a href="<?= $videoSrc ?>" target="_blank">
                                    <button class="video__button"><img src="/img/play.svg" alt=""></button>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="video__container"><img class="video__circle" src="/img/option-2.svg" alt="">
                            <p class="video__text">Доставка по смоленской обл. и России</p>
                        </div>
                        <div class="video__container"><img class="video__circle" src="/img/option-4.svg" alt="">
                            <p class="video__text">Установка с помощью крана-манипулятора</p>
                        </div>
                    </div>
                </div>
                <div class="video__excursion">
                    <p class="video__title">Соверши виртуальную <br> 3D экскурсию по бане бочке</p>
                    <button class="button js-button is-product" area-label="Перейти к обзору панорамы">Перейти к обзору
                        панорамы
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<?= ReviewsSliderWidget::widget() ?>
<?= FaqWidget::widget() ?>

<section class="section">
    <div class="container">
        <div class="section__body">
            <div class="about-text">
                <p class="about-text__text">Наша компания занимается изготовлением бань <i><img
                            src="img/about-icon-1.svg" alt=""></i>эконом-класса для людей, которые желают получить
                    высокое качество при небольших затратах <i><img class="about-text__image" src="img/about-icon-2.svg"
                                                                    alt=""></i>. Попарившись в такой бане, вы больше не
                    сможете отказывать себе в маленьких удовольствиях.</p>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section__body">
            <div class="contact">
                <div class="contact__addresses">
                    <p class="contact__address">г. Смоленск</p>
                    <p class="contact__title">пос. Тихвинка, 69</p>
                    <p class="contact__title">пос. Тихвинка 10</p>
                    <p class="contact__subtitle">(рядом с оптовым продуктовым рынком <br> и остановкой Аэропорт)</p>
                </div>
                <div class="contact__phones">
                    <p class="contact__phone">+8 (920) 338 91 69</p>
                    <p class="contact__phone">+8 (800) 201 42 91</p>
                    <p class="contact__phone">510-110</p>
                </div>
                <div class="contact__emails"><a class="contact__email" href="#">info@smallbani.ru</a></div>
            </div>
        </div>
    </div>
</section>
