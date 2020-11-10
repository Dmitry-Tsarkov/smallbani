<?php

use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var \app\modules\characteristic\models\Characteristic $characteristic
 * @var string $content
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Общее',
                'url' => ['/characteristic/backend/characteristic/create', 'id' => $characteristic->id],
                'active' => Yii::$app->controller->action->id == 'create' && Yii::$app->controller->id == 'backend/create',
            ],
            [
                'label' => 'Варианты',
                'url' => ['/characteristic/backend/characteristic/create-variant', 'id' => $characteristic->id],
                'active' => Yii::$app->controller->id == 'backend/create-variant',
            ],
        ]
    ]) ?>
    <div class="box-body">
        <?= $content ?>
    </div>
</div>
