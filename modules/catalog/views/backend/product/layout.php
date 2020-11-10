<?php

use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var \app\modules\catalog\models\Product $product
 * @var string $content
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Общее',
                'url' => ['/catalog/backend/product/view', 'id' => $product->id],
                'active' => Yii::$app->controller->action->id == 'view' && Yii::$app->controller->id == 'backend/product',
            ],
            [
                'label' => 'Отзывы (' . $product->getReviews()->count('id') . ')',
                'url' => ['/catalog/backend/review/index', 'id' => $product->id],
                'active' => Yii::$app->controller->id == 'backend/review',
            ],
        ]
    ]) ?>
    <div class="box-body">
        <?= $content ?>
    </div>
</div>
