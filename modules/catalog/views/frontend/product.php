<?php

use app\modules\admin\helpers\ContentHelper;
use app\modules\catalog\widgets\ProductValuesWidget;
use app\modules\faq\widgets\ProductFaqWidget;
use app\modules\page\components\Pages;

/**
 * @var $this \yii\web\View
 * @var \app\modules\catalog\models\Product $product
 */

$product->generateMetaTags();
$this->params['breadcrumbs'] = Pages::getParentBreadcrumbs('catalog');
$this->params['breadcrumbs'][] = ['label' => $product->category->title, 'url' => $product->category->getHref()];
$this->params['breadcrumbs'][] = $product->title;
$this->params['h1'] = $product->getH1();


?>

<section class="section is-products">
    <div class="container">
        <div class="section__body">
            <slider-product inline-template>
                <div class="slider-product">
                    <div class="slider-product__container" ref="container">
                        <div class="slider-product__wrapper">
                            <?php foreach ($product->images as $image): ?>
                                <div class="slider-product__slide">
                                    <div class="slider-product__cover"></div>
                                    <img class="slider-product__image"
                                         src="<?= $image->getThumbFileUrl('image', 'view') ?>" alt="">
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
            <div class="product-description">
                <div class="grid is-row">
                    <div class="col-7">
                        <div class="product-description__header">
                            <div class="product-description__description">
                                <p class="product-description__headline">Описание</p>
                                <p class="product-description__text"><?= $product->description ?></p>
                            </div>
                        </div>

                        <?= ProductValuesWidget::widget(compact('product')) ?>

                        <div class="product-description__gifts">
                            <?php if (!empty($product->gift)): ?>
                                <p class="product-description__title">Входит в подарок</p>
                                <ul class="product-description__list">
                                    <?php foreach (ContentHelper::splitText($product->gift) as $gift): ?>
                                        <li class="product-description__item">
                                            <p class="product-description__subtitle"><?= $gift . ''; ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif ?>
                            <slider-blueprint inline-template>
                                <div class="slider-blueprint">
                                    <div class="slider-blueprint__header">
                                        <p class="slider-blueprint__headline">Чертежи</p>
                                        <div class="slider-blueprint__controls">
                                            <button class="slider-blueprint__control is-prev" ref="prev"></button>
                                            <button class="slider-blueprint__control is-last" ref="next"></button>
                                        </div>
                                    </div>
                                    <div class="slider-blueprint__container" ref="container">
                                        <div class="slider-blueprint__wrapper">
                                            <?php foreach ($product->drawings as $drawing): ?>
                                                <div class="slider-blueprint__slide">
                                                    <div class="slider-blueprint__cover">
                                                        <img class="slider-blueprint__image"
                                                             src="<?= $drawing->getThumbFileUrl('image', 'preview') ?>"
                                                             alt="">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </slider-blueprint>
                            <slider-photos inline-template>
                                <div class="slider-photos">
                                    <p class="slider-photos__headline">Фотографии и отзывы</p>

                                    <div class="slider-photos__container" ref="container">

                                        <div class="slider-photos__wrapper">
                                            <?php foreach ($product->clientPhotos as $clients): ?>
                                                <div class="slider-photos__slide">
                                                    <div class="slider-photos__cover"></div>
                                                    <img class="slider-photos__image"
                                                         src="<?= $clients->getThumbFileUrl('image', 'view') ?>" alt="">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="slider-photos__controls">
                                            <div class="container">
                                                <button class="slider-photos__control is-prev" ref="prev"></button>
                                                <button class="slider-photos__control is-last" ref="next"></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="slider-done__buttons is-description">
                                        <button class="button">Попасть на просмотр</button>
                                        <button class="button unfill">Смотреть все отзывы</button>
                                    </div>
                                </div>
                            </slider-photos>
                            <div class="answers is-left">
                                <p class="answers__headline">Вопросы и ответы</p>
                                <?= ProductFaqWidget::widget() ?>
                                <form class="form is-left is-answers" role="form" action="response.html">
                                    <div class="form__body">
                                        <div class="answers__container">
                                            <p class="answers__title">Если вопросы еще остались</p>
                                            <div class="answers__info">
                                                <input class="answers__input" type="text" placeholder="Как вас зовут?">
                                                <input class="answers__input email" type="text"
                                                       placeholder="Электронный адрес">
                                            </div>
                                            <textarea class="answers__textarea"></textarea>
                                            <div class="answers__send">
                                                <button class="button js-button is-send" area-label="Отправить">
                                                    Отправить
                                                </button>
                                                <input class="shipment__checkbox" type="checkbox"> Отправляя сообщение,
                                                вы соглашаетесь на Обработку персональных данных
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-4 shift-1">
                        <div class="product-description__order">
                            <?php foreach ($product->colourGroups as $group): ?>
                                <div class="product-description__select">
                                    <p class="product-description__color-text"><?= $group->title ?>: </p>
                                    <?php foreach ($group->modifications as $toColour): ?>
                                        <input class="product-description__color"
                                               name="colour[<?= $toColour->group_id ?>]" type="radio"
                                               style="box-shadow: 0px 0px 0px 2px <?= $toColour->colour->hex ?>;"
                                               value="<?= $toColour->id ?>">
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                            <button class="button js-button is-order" area-label="Заказать за 178 000 ₽">Заказать за 178
                                000 ₽
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

