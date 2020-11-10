<?php

namespace app\modules\characteristic\forms;

use app\modules\characteristic\helpers\CharacteristicHelper;
use app\modules\characteristic\models\Characteristic;
use yii\base\Model;

class CharacteristicEditForm extends Model
{
    public $title;
    public $unit;
    public $type;

    public function __construct(Characteristic $characteristic)
    {
        $this->title = $characteristic->title;
        $this->unit  = $characteristic->unit;
        $this->type  = $characteristic->type;

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'unit', 'type'], 'string'],
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
