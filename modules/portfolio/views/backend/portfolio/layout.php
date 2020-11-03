<?php

use app\modules\portfolio\models\Portfolio;
use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var Portfolio $portfolio
 * @var string $content
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Общее',
                'url' => ['/portfolio/backend/portfolio/view', 'id' => $portfolio->id],
                'active' => Yii::$app->controller->action->id == 'view' && Yii::$app->controller->id == 'backend/portfolio',
            ],
            [
                'label' => 'Отзывы (' . $portfolio->getReviews()->count('id') . ')',
                'url' => ['/portfolio/backend/review/index', 'id' => $portfolio->id],
                'active' => Yii::$app->controller->id == 'backend/review',
            ],
        ]
    ]) ?>
    <div class="box-body">
        <?= $content ?>
    </div>
</div>

