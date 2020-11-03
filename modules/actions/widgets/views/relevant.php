<?php

use app\modules\catalog\widgets\ProductWidget;
use yii\helpers\Url;

/**
 * @var $this \yii\web\View
 * @var \app\modules\actions\models\Promo[] $actions
 */

?>

<section class="section">
    <div class="container">
        <header class="section__header">
            <h2 class="section__title">Актуальные акции</h2>
        </header>
        <div class="section__body">
            <div class="grid is-row">
            <?php foreach ($actions as $action): ?>
                <div class="col-4">
                    <a class="stock" href="<?= $action->getHref() ?>">
                        <div class="stock__cover">
                            <img class="stock__image" src="<?= $action->getThumbFileUrl('image', 'preview') ?>" alt="">
                        </div>
                        <div class="stock__wrapper">
                            <p class="stock__text"><?= $action->title ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
            </div>
            <a class="button js-button unfill look-all" area-label="Смотреть все" href="<?= Url::to(['/actions/frontend/index']) ?>">Смотреть
                все</a>
        </div>
    </div>
</section>


