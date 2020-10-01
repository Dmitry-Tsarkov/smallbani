<?php

namespace app\modules\catalog\services;

use app\modules\catalog\forms\PhotosForm;
use app\modules\catalog\forms\ProductCreateForm;
use app\modules\catalog\forms\ProductUpdateForm;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductImage;
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

        foreach ($form->photos->files as $file) {
            $product->addImage(ProductImage::create($file));
        }

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
        $product = $this->products->getById($id);

        if (empty($product->category)) {
            throw new \DomainException('Не установлена категория');
        }

        $product->status = 1;

        $this->products->save($product);
    }

    public function draft($id)
    {

    }
}