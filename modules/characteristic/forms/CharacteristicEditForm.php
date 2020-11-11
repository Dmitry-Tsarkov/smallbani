<?php

namespace app\modules\characteristic\forms;

use app\modules\characteristic\helpers\CharacteristicHelper;
use app\modules\characteristic\models\Characteristic;
use yii\base\Model;

class CharacteristicEditForm extends Model
{
    public $title;
    public $unit;

    public function __construct(Characteristic $characteristic)
    {
        $this->title = $characteristic->title;
        $this->unit  = $characteristic->unit;

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'unit'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'unit'  => 'Ед. измерения',
        ];
    }

    public function getTypesDropDown()
    {
        return CharacteristicHelper::TypeList();
    }

}
