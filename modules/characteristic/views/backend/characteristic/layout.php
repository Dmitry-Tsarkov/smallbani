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
                'url' => ['/characteristic/backend/characteristic/update', 'id' => $characteristic->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [
                'label' => 'Варианты (' . $characteristic->getVariants()->count('id') . ')',
                'url' => ['/characteristic/backend/variant/index', 'id' => $characteristic->id],
                'active' => Yii::$app->controller->action->id == 'index',
                'visible' => $characteristic->isDropDown(),
            ],
        ]
    ]) ?>
    <div class="box-body">
        <?= $content ?>
    </div>
</div>
