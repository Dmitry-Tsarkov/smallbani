<?php


namespace app\modules\feedback\forms;


use app\modules\feedback\validators\PhoneValidator;
use yii\base\Model;

class CallbackForm extends Model
{
    public $name;
    public $phone;

    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['name', 'phone'], 'string'],
            ['phone', PhoneValidator::class]
        ];
    }
}
