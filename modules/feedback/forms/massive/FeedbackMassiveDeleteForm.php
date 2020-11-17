<?php

namespace app\modules\feedback\forms\massive;

use yii\base\Model;

class FeedbackMassiveDeleteForm extends Model
{
    public $ids;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            ['ids', 'required'],
            ['ids', 'each', 'rule' => ['integer']],
        ];
    }
}