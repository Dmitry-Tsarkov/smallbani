<?php


namespace app\modules\catalog\widgets;

use app\modules\catalog\readModels\ProductReadRepository;
use yii\base\Widget;

class PopularProductsWidget extends Widget
{
    private $products;

    public function __construct(ProductReadRepository $products, $config = [])
    {
        parent::__construct($config);
        $this->products = $products;
    }

    public function run()
    {
        $products = $this->products->getPopular();
        return $this->render('popular', compact('products'));
    }
}
