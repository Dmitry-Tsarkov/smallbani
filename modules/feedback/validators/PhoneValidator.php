<?php

namespace app\modules\feedback\validators;

use app\modules\feedback\models\Phone;
use yii\validators\Validator;

class PhoneValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (!Phone::isValidPhone($model->$attribute)) {
            $this->addError($model, $attribute, 'Некорректный телефон');
        }
    }
}
