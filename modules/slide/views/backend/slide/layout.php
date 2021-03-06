<?php

use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var \app\modules\slide\models\Slide $slide
 * @var string $content
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Общее',
                'url' => ['update', 'id' => $slide->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [
                'label' => 'Действия',
                'headerOptions' => ['class' => 'pull-right'],
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="fa fa-remove text-danger" aria-hidden="true"></i>Удалить слайд',
                        'url' => ['/slide/backend/slide/delete', 'id' => $slide->id],
                        'linkOptions' => [
                            'class' => 'text-danger',
                            'data-method' => 'post',
                            'data-confirm' => 'Вы уверены?',
                        ],
                    ],
                ],
            ],
        ]
    ]) ?>
    <div class="box-body">
        <?= $content ?>
    </div>
</div>
