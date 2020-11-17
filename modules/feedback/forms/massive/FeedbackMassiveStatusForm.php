<?php

namespace app\modules\feedback\forms\massive;

use app\modules\feedback\helpers\StatusHelper;
use app\modules\feedback\models\FeedbackStatus;
use yii\base\Model;

class FeedbackMassiveStatusForm extends Model
{
    public $ids;
    public $statusId;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['ids', 'statusId'], 'required'],
            ['ids', 'each', 'rule' => ['integer']],
            ['statusId', 'integer'],
            ['statusId', 'in', 'range' => array_keys(FeedbackStatus::list())],
        ];
    }
}
