<?php

namespace app\modules\catalog\services;

use app\modules\catalog\forms\ProductCreateForm;
use app\modules\catalog\forms\ProductUpdateForm;
use app\modules\catalog\models\Product;
use app\modules\catalog\repositories\ProductRepository;

class ProductService
{
    private $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function create(ProductCreateForm $form): Product
    {
        $product = Product::create(
            $form->title,
            $form->alias,
            $form->description,
            $form->categoryId
        );

        $this->products->save($product);

        return $product;
    }

    public function update($id, ProductUpdateForm $form): void
    {
        $product = $this->products->getById($id);

        $product->edit(
            $form->title,
            $form->alias,
            $form->description,
            $form->categoryId
        );

        $this->products->save($product);
    }

    public function delete($id)
    {
        $product = $this->products->getById($id);

        if ($product->status == 1) {
            throw new \DomainException('Нельзя удалить активный товар');
        }

        $this->products->delete($product);
    }

    public function activate($id)
    {

    }

    public function draft($id)
    {

    }
}