<?php


namespace app\modules\catalog\widgets;


use app\modules\catalog\models\Product;
use yii\base\Widget;

/**
 * @property Product $product
 */
class ProductValuesWidget extends Widget
{
    public $product;

    public function run()
    {
        $basicValues = [];
        $additionalValues = [];

        foreach ($this->product->values as $value) {
            if ($value->is_basic_set) {
                $basicValues[] = $value;
            } else {
                $additionalValues[] = $value;
            }
        }

        return $this->render('product_values', compact('basicValues', 'additionalValues'));
    }
}
