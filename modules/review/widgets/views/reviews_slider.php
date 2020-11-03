<?php

use app\modules\review\widgets\ReviewWidget;

/**
 * @var $this \yii\web\View
 * @var \app\modules\review\models\Review[] $reviews
 */



?>

<slider-done inline-template>
    <div class="container">
        <div class="slider-done">
            <p class="slider-done__headline">Успели сделать и поставить</p>
            <div class="slider-done__container" ref="container">
                <div class="slider-done__wrapper">
                    <?php foreach ($reviews as $review): ?>
                        <div class="slider-done__slide">
                            <div class="review">
                                <div class="review__content">
                                    <?= ReviewWidget::widget(compact('review')) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="slider-done__controls">
                    <button class="slider-done__control is-prev" ref="prev"></button>
                    <button class="slider-done__control is-last" ref="next"></button>
                </div>
            </div>
            <div class="slider-done__buttons">
                <button class="button">Попасть на просмотр</button>
                <button class="button unfill">Смотреть все отзывы</button>
            </div>
        </div>
    </div>
</slider-done>
