<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $review \app\modules\review\models\Review */

?>

<?php if (!empty($review)): ?>
    <div class="review">
        <div class="review__cover">
            <img class="review__image" src="<?= $review->getThumbFileUrl('image', 'preview') ?>" alt="">
        </div>
        <div class="review__content">
            <p class="review__title"><?= Html::encode($review->name.', '.$review->place)?></p>
            <p class="review__text"><?= Html::encode($review->review) ?></p>
        </div>
    </div>
<?php endif ?>
