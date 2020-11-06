<?php


namespace app\modules\order\forms;

use yii\base\Model;

class OrderForm extends Model
{
    public $name;
    public $phone;
    public $productId;
    public $modificationIds = [];

    public function rules()
    {
        return [
            [['phone', 'productId'], 'required'],
            [['name'], 'string'],
            [['productId'], 'integer'],
            ['modificationIds', 'each', 'rule' =>  ['integer']],
        ];
    }
}
