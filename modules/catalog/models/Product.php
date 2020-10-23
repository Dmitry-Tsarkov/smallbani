<?php


namespace app\modules\catalog\models;

use app\modules\admin\behaviors\ImageBehavior;
use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\review\models\Review;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * @property string $id
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property string $description
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $category_id [int(11)]
 * @property int $image_id [int(11)]
 * @property int $gift [int(11)]
 * @property bool $is_popular [tinyint(1)]
 *
 * @property Category $category
 * @property ProductImage[] $images
 * @property ProductImage $mainImage
 * @property ProductDrawing[] $drawings
 * @property ClientPhoto[] $clientPhotos
 */
class Product extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SlugBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['images', 'drawings', 'clientPhotos'],
            ],
        ];
    }

    public static function create($title, $alias, $description, $categoryId): Product
    {
        $product = new Product();
        $product->title = $title;
        $product->alias = $alias;
        $product->description = $description;
        $product->category_id = $categoryId;
        $product->status = self::STATUS_DRAFT;
        $product->is_popular = false;

        return $product;
    }

    public function edit($title, $alias, $description, $categoryId)
    {
        $this->title = $title;
        $this->alias = $alias;
        $this->description = $description;
        $this->category_id = $categoryId;
    }

    public function addImage(ProductImage $image)
    {
        $images = $this->images;
        $images[] = $image;
        $this->updateImages($images);
    }

    public function sortImages(int $oldIndex, int $newIndex)
    {
        $images = $this->images;
        $tmp = $images[$oldIndex];
        array_splice($images, $oldIndex, 1);
        array_splice($images, $newIndex, 0, [$tmp]);
        $this->updateImages($images);
    }

    public function deleteImage($photoId)
    {
        $images = $this->images;
        foreach ($images as $i => $image) {
            if ($image->id == $photoId) {
                unset($images[$i]);
                $this->updateImages($images);
                return;
            }
        }
        throw new \DomainException('Картинка не найдена');
    }

    public function addDrawing(ProductDrawing $drawing)
    {
        $drawings = $this->drawings;
        $drawings[] = $drawing;
        $this->updateDrawings($drawings);
    }

    public function removeDrawing($id): void
    {
        $drawings = $this->drawings;
        foreach ($drawings as $i => $drawing) {
            if ($drawing->id == $id) {
                unset($drawings[$i]);
                $this->updateDrawings($drawings);
                return;
            }
        }
        throw new \DomainException('Чертеж не найден');
    }

    public function sortDrawing(int $oldIndex, int $newIndex)
    {
        $drawings = $this->drawings;
        $tmp = $drawings[$oldIndex];
        array_splice($drawings, $oldIndex, 1);
        array_splice($drawings, $newIndex, 0, [$tmp]);
        $this->updateDrawings($drawings);
    }

    /**
     * @param ProductDrawing[] $drawings
     */
    private function updateDrawings(array $drawings)
    {
        foreach ($drawings as $i => $image) {
            $image->setPosition($i + 1);
        }
        $this->drawings = $drawings;
    }

    public function addClientPhoto(ClientPhoto $photo)
    {
        $photos = $this->clientPhotos;
        $photos[] = $photo;
        $this->updateClientPhotos($photos);
    }

    public function removeClientPhoto($id): void
    {
        $photos = $this->clientPhotos;
        foreach ($photos as $i => $photo) {
            if ($photo->id == $id) {
                unset($photos[$i]);
                $this->updateClientPhotos($photos);
                return;
            }
        }
        throw new \DomainException('Фото не найдено');
    }

    public function sortClientPhotos(int $oldIndex, int $newIndex)
    {
        $photos = $this->clientPhotos;
        $tmp = $photos[$oldIndex];
        array_splice($photos, $oldIndex, 1);
        array_splice($photos, $newIndex, 0, [$tmp]);
        $this->updateClientPhotos($photos);
    }



    /**
     * @param ClientPhoto[] $photos
     */
    private function updateClientPhotos(array $photos)
    {
        foreach ($photos as $i => $photo) {
            $photo->setPosition($i + 1);
        }
        $this->clientPhotos = $photos;
    }

    public function activate()
    {
        if ($this->status == self::STATUS_ACTIVE) {
            throw new \DomainException('Товар уже активирован');
        }

        if (empty($this->category)) {
            throw new \DomainException('Не установлена категория');
        }

        $this->status = Product::STATUS_ACTIVE;
    }

    public function draft()
    {
        if ($this->status == self::STATUS_DRAFT) {
            throw new \DomainException('Товар уже заблокирвоан');
        }
        $this->status = Product::STATUS_DRAFT;
    }

    public function popular()
    {
        if ($this->is_popular) {
            throw new \DomainException('Товар уже популярный');
        }

        $this->is_popular = true;
    }

    public function usual()
    {
        if (!$this->is_popular) {
            throw new \DomainException('Товар уже не популярный');
        }
        $this->is_popular = false;
    }

    public function isActive(): bool
    {
        return $this->status == Product::STATUS_ACTIVE;
    }

    /**
     * @param ProductImage[] $images
     */
    private function updateImages(array $images)
    {
        foreach ($images as $i => $image) {
            $image->setPosition($i + 1);
        }
        $this->images = $images;
        $this->populateRelation('mainImage', reset($images));
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'status' => 'Статус',
            'alias' => 'Алиас',
            'category_id' => 'Категория',
            'description' => 'Описание',
            'gift' => 'Входит в подарок',
            'is_popular' => 'Популярный товар'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' =>'category_id']);
    }

    public function getImages()
    {
        return $this->hasMany(ProductImage::class, ['product_id' => 'id'])->orderBy('position');
    }

    public function getMainImage()
    {
        return $this->hasOne(ProductImage::class, ['id' => 'image_id']);
    }

    public function getDrawings()
    {
        return $this->hasMany(ProductDrawing::class, ['product_id' => 'id'])->orderBy('position');
    }

    public function getClientPhotos()
    {
        return $this->hasMany(ClientPhoto::class, ['product_id' => 'id'])->orderBy('position');
    }

    public function afterSave($insert, $changedAttributes)
    {
        $related = $this->getRelatedRecords();
        parent::afterSave($insert, $changedAttributes);
        if (array_key_exists('mainImage', $related)) {
            $this->updateAttributes(['image_id' => $related['mainImage'] ? $related['mainImage']->id : null]);
        }
    }

    public function hasMainImage(): bool
    {
        return !empty($this->image_id) && !empty($this->mainImage->getUploadedFilePath('image'));
    }

    public function getMainImagePreview()
    {
        return $this->hasMainImage() ? $this->mainImage->getThumbFileUrl('image', 'preview') : '';
    }

    public static function tableName()
    {
        return '{{catalog_products}}';
    }

    public function getHref()
    {
        return Url::to(['/catalog/frontend/product', 'alias' => $this->alias]);
    }

    public function getReviews()
    {
        return $this->hasMany(Review::class, ['product_id' => 'id']);
    }
}
