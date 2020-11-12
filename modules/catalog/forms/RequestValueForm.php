<?php


namespace app\modules\catalog\forms;


use app\modules\catalog\models\Product;
use app\modules\characteristic\models\Characteristic;
use yii\base\Model;

class RequestValueForm extends Model
{
    public $characteristic_id;

    private $product;

    public function __construct(Product $product)
    {
        parent::__construct();
        $this->product = $product;
    }

    public function getCharacteristicDropDown()
    {
        return Characteristic::find()->select('title')->indexBy('id')->orderBy('title')->column();
    }

    public function getDisabledOptions()
    {
        $ids =  $this->product->getValues()
            ->alias('v')
            ->joinWith('characteristic c')
            ->select('c.id')
            ->indexBy('c.id')
            ->groupBy('c.id')
            ->orderBy('c.id')
            ->column();

        return array_map(function($id) {
            return ['disabled' => true];
        }, $ids);
    }

    public function rules()
    {
        return [
            [['characteristic_id'], 'required'],
            [['characteristic_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'characteristic_id'  => 'Характеристика',
        ];
    }

}
