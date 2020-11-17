<?php

use app\modules\feedback\models\FeedbackStatus;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var \yii\web\View $this
 * @var \app\modules\feedback\models\Feedback $feedback
 */

?>

<?= DetailView::widget([
    'model' => $feedback,
    'attributes' => [
        'id',
        [
            'label' => 'Статус ',
            'format' => 'raw',
            'value' => function(\app\modules\feedback\models\Feedback $feedback) {
                $options = '';
                foreach (FeedbackStatus::list() as $value => $status) {
                    if ($feedback->status->getValue() == $value) {
                        continue;
                    }
                    $options .= '<li>' . Html::a($status, ['change-status', 'id' => $feedback->id, 'status' => $value], ['data-method' => 'post']) . '</li>';
                }

                return
                    '<div class="dropdown">
                                  <button class="btn btn-' . $feedback->status->getClass() . ' btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ' . $feedback->status->getLabel() . '
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">'. $options .'</ul>
                                </div>';
            },
        ],

        'name',
        'portfolio_title',
        'portfolio_id',
        [
            'attribute' => 'type',
            'value' => \app\modules\feedback\helpers\FeedbackHelper::getTypeLabel($feedback->type),
        ],
        [
            'label' => 'Дата создания',
            'value' => date('d.m.Y H:i', $feedback->created_at)
        ],
        [
            'label' => 'Дата редактирования',
            'value' => date('d.m.Y H:i', $feedback->updated_at)
        ],
    ],
]); ?>
