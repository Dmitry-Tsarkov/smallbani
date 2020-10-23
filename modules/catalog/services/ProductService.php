<?php

namespace app\modules\catalog\services;

use app\modules\catalog\forms\ClientPhotosForm;
use app\modules\catalog\forms\DrawingsForm;
use app\modules\catalog\forms\PhotosForm;
use app\modules\catalog\forms\ProductCreateForm;
use app\modules\catalog\forms\ProductUpdateForm;
use app\modules\catalog\models\ClientPhoto;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductDrawing;
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

        foreach ($form->drawings->files as $file) {
            $product->addDrawing(ProductDrawing::create($file));
        }

        foreach ($form->client->files as $file) {
            $product->addClientPhoto(ClientPhoto::create($file));
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
        $product->activate();
        $this->products->save($product);
    }

    public function draft($id)
    {
        $product = $this->products->getById($id);
        $product->draft();
        $this->products->save($product);
    }

    public function popular($id)
    {
        $product = $this->products->getById($id);
        $product->popular();
        $this->products->save($product);
    }

    public function usual($id)
    {
        $product = $this->products->getById($id);
        $product->usual();
        $this->products->save($product);
    }

    public function addImage($id, PhotosForm $form)
    {
        $product = $this->products->getById($id);

        foreach ($form->files as $file) {
            $product->addImage(ProductImage::create($file));
        }

        $this->products->save($product);
    }

    public function deleteImage($id, $photoId)
    {
        $product = $this->products->getById($id);
        $product->deleteImage($photoId);
        $this->products->save($product);
    }

    public function sortImages($id, $oldIndex, $newIndex)
    {
        $product = $this->products->getById($id);
        $product->sortImages($oldIndex, $newIndex);
        $this->products->save($product);
    }

    public function addDrawing($id, DrawingsForm $form)
    {
        $product = $this->products->getById($id);
        foreach ($form->files as $file) {
            $product->addDrawing(ProductDrawing::create($file));
        }
        $this->products->save($product);
    }

    public function removeDrawing($id, $drawingId)
    {
        $product = $this->products->getById($id);
        $product->removeDrawing($drawingId);
        $this->products->save($product);
    }

    public function sortDrawing($id, $oldIndex, $newIndex)
    {
        $product = $this->products->getById($id);
        $product->sortDrawing($oldIndex, $newIndex);
        $this->products->save($product);
    }

    public function addClientPhoto($id, ClientPhotosForm $form)
    {
        $product = $this->products->getById($id);
        foreach ($form->files as $file) {
            $product->addClientPhoto(ClientPhoto::create($file));
        }
        $this->products->save($product);
    }

    public function removeClientPhoto($id, $photoId)
    {
        $product = $this->products->getById($id);
        $product->removeClientPhoto($photoId);
        $this->products->save($product);
    }

    public function sortClientPhotos($id, $oldIndex, $newIndex)
    {
        $product = $this->products->getById($id);
        $product->sortClientPhotos($oldIndex, $newIndex);
        $this->products->save($product);
    }
}
