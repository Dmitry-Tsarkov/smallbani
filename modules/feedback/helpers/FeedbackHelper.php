<?php


namespace app\modules\feedback\helpers;


use app\modules\feedback\models\Feedback;
use app\modules\feedback\models\FeedbackStatus;

class FeedbackHelper
{
    public static function badge($number)
    {
        if (empty($number)) {
            return '';
        }
        return '<span class="pull-right-container"><span class="label label-primary pull-right">' . $number . '</span></span>';
    }

    public static function newCount($type = null)
    {
        return Feedback::find()->andFilterWhere(['type' => $type])->andWhere(['status' => FeedbackStatus::NEW])->count('id');
    }

    public static function getTypeLabel($type)
    {
        switch ($type) {
            case Feedback::TYPE_FEEDBACK: return 'Обратная связь';
            case Feedback::TYPE_PORTFOLIO: return 'Заказать такую-же';
            case Feedback::TYPE_CALLBACK: return 'Перезвонить';
        }
    }
}
