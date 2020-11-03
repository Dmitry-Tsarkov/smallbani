<?php


/**
 * @var $this \yii\web\View
 * @var \app\modules\portfolio\models\Portfolio $portfolio
 * @var \app\modules\review\models\Review[] $reviews
 */

use app\modules\admin\helpers\YoutubeHelper;
use app\modules\page\components\Pages;
use app\modules\review\widgets\ReviewWidget;
use yii\helpers\Url;

$portfolio->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs('portfolio');
$this->params['breadcrumbs'][] = $portfolio->title;
$this->params['h1'] = $portfolio->getH1();

?>

<section class="section">
    <div class="container">
        <div class="section__body">
            <slider-product inline-template>
                <div class="slider-product">
                    <div class="slider-product__container" ref="container">
                        <div class="slider-product__wrapper">
                            <?php foreach ($portfolio->images as $image): ?>
                                <div class="slider-product__slide">
                                    <div class="slider-product__cover"></div>
                                    <img class="slider-product__image" src="<?= $image->getThumbFileUrl('image','view') ?>" alt="">
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="slider-product__bullets" ref="pagination"></div>
                        <div class="slider-product__controls">
                            <div class="container">
                                <button class="slider-product__control is-prev" ref="prev"></button>
                                <button class="slider-product__control is-last" ref="next"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </slider-product>
            <div class="grid is-row">
                <div class="col-7">
                    <div>
                        <?= $portfolio->description; ?>
                    </div>
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                            <?= ReviewWidget::widget(compact('review')) ?>
                        <?php endforeach ?>
                        <a class="button js-button unfill" area-label="Смотреть все отзывы" href="<?= Url::to(['/review/frontend/index'])?>">Смотреть все отзывы</a>
                    <?php endif ?>

                    <?php if ($portfolio->hasYoutubeUrl()): ?>
                        <div class="video-portfolio">
                            <div class="video-portfolio__cover">
                                <img class="video-portfolio__image" src="<?= YoutubeHelper::previewImage($portfolio->youtube_url) ?>" alt="">
                                <a href="<?= YoutubeHelper::url($portfolio->youtube_url) ?>" target="_blank">
                                    <button class="video-portfolio__button">
                                        <img class="video-portfolio__play" src="/img/play.svg" alt="">
                                    </button>
                                </a>
                            </div>
                            <div class="video-portfolio__buttons">
                                <a class="button js-button is-product"
                                   area-label="Заказать такую же"
                                   href="/product-detailed.html">Заказать такую же</a>
                                <a
                                    class="button js-button unfill" area-label="Попасть на просмотр"
                                    href="/product-detailed.html">Попасть на просмотр</a>
                            </div>
                        </div>
                    <?php endif ?>

                </div>
                <div class="col-4 shift-1">
                    <form class="form is-small is-info" role="form" action="response.html">
                        <div class="form__body">
                            <div class="form__container">
                                <p class="form__title">Узнать подробнее</p>
                                <div class="form__info">
                                    <input class="form__input" type="text" placeholder="Ваше имя">
                                    <input class="form__input email" type="text" placeholder="Ваша почта">
                                </div>
                                <textarea class="form__textarea" placeholder="Что необходимо узнать?"></textarea>
                                <div class="form__send">
                                    <button class="button js-button is-send" area-label="Отправить">Отправить</button>
                                    <input class="shipment__checkbox" type="checkbox"> Отправляя сообщение, вы
                                    соглашаетесь на Обработку персональных данных
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


