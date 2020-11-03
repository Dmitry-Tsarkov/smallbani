<?php


namespace app\modules\catalog\widgets;


use app\modules\catalog\models\Product;
use yii\base\Widget;

/**
 * @property Product $product
 */
class ProductWidget extends Widget
{
    public $product;

    public function run()
    {
        return $this->render('product', ['product' => $this->product]);
    }
}
