<?php

/**
 * @var $this \yii\web\View
 * @var \app\modules\slide\models\Slide[] $slides
 */

?>

<?php if (!empty($slides)): ?>
    <slider-main inline-template>
        <div class="slider-main">
            <div class="slider-main__container" ref="container">
                <div class="slider-main__wrapper">
                    <?php foreach($slides as $slide): ?>
                        <div class="slider-main__slide">
                            <div class="slider-main__cover"></div>
                            <img class="slider-main__image" src="<?=$slide->getThumbFileUrl('image', 'view')?>" alt="">
                            <div class="container">
                                <div class="slider-main__content">
                                    <p class="slider-main__text" data-swiper-parallax="-100"><?= $slide->title?></p>
                                    <?php if (!empty($slide->link_text) && !empty($slide->link_href)): ?>
                                        <div class="slider-main__button" data-swiper-parallax="-50">
                                            <a href="<?= $slide->link_href ?>" class="button is-detailed" <?= $slide->link_is_blank ? 'target="_blank"' : '' ?>>Узнать подробнее</a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="slider-main__bullets" ref="pagination"></div>
                <div class="slider-main__controls">
                    <div class="container">
                        <button class="slider-main__control is-prev" ref="prev"> </button>
                        <button class="slider-main__control is-last" ref="next"> </button>
                    </div>
                </div>
            </div>
        </div>
    </slider-main>
<?php endif ?>
