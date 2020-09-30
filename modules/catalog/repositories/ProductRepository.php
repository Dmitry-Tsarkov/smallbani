<?php

namespace app\modules\catalog\repositories;

use app\modules\catalog\models\Product;

class ProductRepository
{
    public function save(Product $product)
    {
        if(!$product->save()) {
            throw new \RuntimeException('Product saving error');
        }
    }

    public function getById($id): Product
    {
        if (!$product = Product::findOne($id)) {
            throw new \DomainException('Товар не найден');
        }

        return $product;
    }

    public function delete(Product $product): void
    {
        if (!$product->delete()) {
            throw new \DomainException('Product deleting error');
        }
    }
}