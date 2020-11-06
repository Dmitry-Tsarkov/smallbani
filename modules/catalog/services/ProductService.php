<?php

namespace app\modules\catalog\services;

use app\modules\catalog\forms\ColourGroupForm;
use app\modules\catalog\forms\ValueForm;
use app\modules\catalog\models\ColourGroup;
use app\modules\characteristic\repositories\CharacteristicRepository;
use app\modules\seo\valueObjects\Seo;
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
use yii\db\Exception;

class ProductService
{
    private $products;
    private $characteristics;

    public function __construct(ProductRepository $products, CharacteristicRepository $characteristics)
    {
        $this->products = $products;
        $this->characteristics = $characteristics;
    }

    public function create(ProductCreateForm $form): Product
    {
        $product = Product::create(
            $form->title,
            $form->alias,
            $form->description,
            $form->categoryId,
            $form->gift,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
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
            $form->categoryId,
            $form->gift,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
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


    public function addColourGroup($product_id, ColourGroupForm $form)
    {
        $product = $this->products->getById($product_id);
        $product->addColourGroup(
            ColourGroup::create(
                $form->title,
                $form->colourIds
            )
        );
        $this->products->save($product);
    }

    public function updateColourGroup($product_id, $group_id, ColourGroupForm $form)
    {
        $product = $this->products->getById($product_id);
        $product->updateColourGroup(
            $group_id,
            $form->title,
            $form->colourIds
        );
        $this->products->save($product);
    }

    public function deleteColourGroup($product_id, $group_id)
    {
        $product = $this->products->getById($product_id);
        $product->deleteColourGroup($group_id);
        $this->products->save($product);
    }

    public function addValue($id, ValueForm $form)
    {
        $product = $this->products->getById($id);
        $characteristic = $this->characteristics->getById($form->characteristicId);
        $product->setValue($characteristic->createValue($form->value, $form->isMain));
        $this->products->save($product);
    }

    public function editValue($id, ValueForm $form)
    {
        $product = $this->products->getById($id);
        $characteristic = $this->characteristics->getById($form->characteristicId);
        $product->setValue($characteristic->createValue($form->value, $form->isMain));
        $this->products->save($product);
    }

    public function deleteValue($id, $valueId)
    {
        $product = $this->products->getById($id);
        $product->removeValue($valueId);
        $this->products->save($product);
    }
}
