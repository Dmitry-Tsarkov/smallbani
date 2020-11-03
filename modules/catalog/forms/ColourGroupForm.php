<?php


namespace app\modules\catalog\forms;


use app\modules\catalog\models\ColourGroup;
use app\modules\colour\models\Colour;
use yii\base\Model;

class ColourGroupForm extends model
{
    public $title;
    public $colourIds = [];

    public function __construct(?ColourGroup $group = null)
    {
        if ($group) {
            $this->title = $group->title;
            $this->colourIds = $group->colourIds;
        }
        parent::__construct();
    }

    public function formName()
    {
        return 'ColourGroupForm';
    }

    public function rules()
    {
        return [
            [['title', 'colourIds'], 'required'],
            [['colourIds'], 'each', 'rule' => ['integer']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'colourIds' => 'Цвета',
        ];
    }

    public function getColoursDropDown()
    {
        return Colour::find()->select('title')->indexBy('id')->column();
    }

}
