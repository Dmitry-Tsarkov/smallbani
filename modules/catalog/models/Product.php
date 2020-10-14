<?php


namespace app\modules\catalog\models;

use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

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
 *
 * @property Category $category
 * @property ProductImage[] $images
 * @property ProductImage $mainImage
 */
class Product extends ActiveRecord
{
    use QueryExceptions;

    public static function tableName()
    {
        return '{{catalog_products}}';
    }

    public static function create($title, $alias, $description, $categoryId): Product
    {
        $product = new Product();
        $product->title = $title;
        $product->alias = $alias;
        $product->description = $description;
        $product->category_id = $categoryId;
        $product->status = 0;

        return $product;
    }

    public function edit($title, $alias, $description, $categoryId)
    {
        $this->title = $title;
        $this->alias = $alias;
        $this->description = $description;
        $this->category_id = $categoryId;
    }

    public function behaviors()
    {

        return [
            TimestampBehavior::class,
            SlugBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['images'],
            ],
        ];
    }
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['title', 'alias', 'description'], 'string'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
            ['status', 'integer'],
            ['status', 'in', 'range' => [0, 1], 'message' => 'Некоректный статус'],
            [['category_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'status' => 'Статус',
            'alias' => 'Алиас',
            'category_id' => 'Категория',
            'description' => 'Описание',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' =>'category_id']);
    }

    public function getImages()
    {
        return $this->hasMany(ProductImage::class, ['product_id' => 'id']);
    }

    public function getMainImage()
    {
        return $this->hasOne(ProductImage::class, ['id' => 'image_id']);
    }

    public function addImage(ProductImage $image)
    {
        $images = $this->images;
        $images[] = $image;
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

    /**
     * @param ProductImage[] $images
     */
    public function updateImages(array $images)
    {
        foreach ($images as $i => $image) {
            $image->setPosition($i + 1);
        }
        $this->images = $images;
        $this->populateRelation('mainImage', reset($images));
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
}
