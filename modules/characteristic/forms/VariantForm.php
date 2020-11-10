<?php


namespace app\modules\characteristic\forms;


use app\modules\characteristic\models\Variant;
use yii\base\Model;

class VariantForm extends Model
{
    public $value;
    

    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'value' => 'значение',
        ];
    }
}
