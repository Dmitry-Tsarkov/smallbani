<?php


namespace app\modules\catalog\forms;


use app\modules\catalog\models\Product;
use app\modules\characteristic\models\Characteristic;
use yii\base\Model;

class ValueForm extends Model
{
    public $value;
    public $isMain;

    private $characteristic;

    public function __construct(Characteristic $characteristic, ?Product $product = null)
    {
        if ($product) {
            if ($value = $product->findValueByCharacteristic($characteristic->id)) {
                $this->value = $value->getValue();
            }
        }
        parent::__construct();
        $this->characteristic = $characteristic;
    }

    public function rules()
    {
        return [
            ['isMain', 'boolean'],
            ['value', 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'value' => 'Значение',
            'variantId' => 'Значение',
            'isMain' => 'Базовая комплектация',
        ];
    }

    public function isDropDown()
    {
        return $this->characteristic->isDropDown();
    }

    public function getVariantsDropDown()
    {
        return $this->characteristic
            ->getVariants()
            ->select('value')
            ->indexBy('id')
            ->column();
    }

    public function getLabel()
    {
        return $this->characteristic->title;
    }

}
