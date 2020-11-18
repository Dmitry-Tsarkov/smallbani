<?php


namespace app\modules\feedback\forms;

use yii\base\Model;

class PortfolioForm extends Model
{
    public $portfolioId;
    public $name;
    public $phone;

    public function rules()
    {
        return [
            [['name', 'phone', 'portfolioId'], 'required'],
            [['name'], 'string'],
            [['phone', 'portfolioId'], 'integer'],

        ];
    }

}
