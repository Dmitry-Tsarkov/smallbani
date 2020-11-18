<?php


namespace app\modules\feedback\forms;


use yii\base\Model;

class FeedbackForm extends Model
{
    public $name;
    public $email;
    public $text;

    public function rules()
    {
        return [
            [['name', 'email', 'text'], 'required'],
            [['name', 'email', 'text'], 'string'],
        ];
    }

}
