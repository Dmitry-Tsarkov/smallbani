<?php

/**
 * @var $this \yii\web\View
 * @var \app\modules\portfolio\models\Portfolio $portfolio
 *
 */

use yii\helpers\Url;

?>

<slider-portfolio inline-template>
    <div class="slider-portfolio">
        <p class="slider-portfolio__headline"><?= $portfolio->title; ?></p>
        <div class="slider-portfolio__container" ref="container">
            <div class="slider-portfolio__wrapper">
                <?php foreach($portfolio->images as $image ): ?>
                   <div class="slider-portfolio__slide">
                       <div class="slider-portfolio__cover"></div>
                       <img class="slider-portfolio__image" src="<?= $image->getThumbFileUrl('image', 'preview') ?>" alt="">
                   </div>
                <?php endforeach ?>
            </div>
            <div class="slider-portfolio__controls">
                <div class="container">
                    <button class="slider-portfolio__control is-prev" ref="prev"> </button>
                    <button class="slider-portfolio__control is-last" ref="next"> </button>
                </div>
            </div>
        </div>
        <div class="slider-portfolio__buttons is-description"><a class="button js-button is-main" area-label="Узнать больше" href="<?= $portfolio->getHref() ?>">Узнать больше</a><a class="button js-button unfill" area-label="Попасть на просмотр" href="/index.html">Попасть на просмотр</a>
        </div>
    </div>
</slider-portfolio>
