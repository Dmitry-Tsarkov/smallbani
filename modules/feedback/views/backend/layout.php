<?php

use app\modules\feedback\helpers\FeedbackHelper;
use app\modules\feedback\models\Feedback;
use yii\widgets\Menu;

$this->title = 'Заявки';
$this->params['breadcrumbs'] = [
    'Заявки',
];
?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">

            <div class="box-body no-padding">
                <?= Menu::widget([
                    'encodeLabels' => false,
                    'options' => ['class' => 'nav nav-pills nav-stacked'],
                    'items' => [
                        [
                            'label' => '<i class="fa fa-bell-o"></i>Обратная связь' .  FeedbackHelper::badge(FeedbackHelper::newCount(Feedback::TYPE_FEEDBACK)),
                            'url' => ['/feedback/backend/feedback/index']
                        ],
                        [
                            'label' => '<i class="fa fa-circle-o"></i>Заказать такую-же'  . FeedbackHelper::badge(FeedbackHelper::newCount(Feedback::TYPE_PORTFOLIO)),
                            'url' => ['/feedback/backend/feedback-portfolio/index']
                        ],
                        [
                            'label' => '<i class="fa fa-phone-square"></i>Перезвонить' .  FeedbackHelper::badge(FeedbackHelper::newCount(Feedback::TYPE_CALLBACK)),
                            'encode' => false,
                            'url' => ['/feedback/backend/callback/index']
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <?= $content ?>
    </div>
</div>

