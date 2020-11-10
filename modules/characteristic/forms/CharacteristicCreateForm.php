<?php


namespace app\modules\characteristic\forms;


use app\modules\characteristic\helpers\CharacteristicHelper;
use app\modules\characteristic\models\Characteristic;
use yii\base\Model;

class CharacteristicCreateForm extends Model
{
    public $title;
    public $unit;
    public $type;

    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['title', 'unit'], 'string'],
            [['type'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'unit'  => 'Ед. измерения',
            'type'  => 'Как будет вводиться информация',
        ];
    }

    public function getTypesDropDown()
    {
        return CharacteristicHelper::TypeList();
    }

}
