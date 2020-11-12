<?php


namespace app\modules\catalog\models;

use app\modules\characteristic\models\Value;
use app\modules\seo\behaviors\SeoBehavior;
use app\modules\seo\valueObjects\Seo;
use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\review\models\Review;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
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
 * @property string $meta_t [varchar(255)]
 * @property string $meta_d [varchar(255)]
 * @property string $meta_k [varchar(255)]
 * @property string $h1 [varchar(255)]
 *
 * @property Category $category
 * @property ProductImage[] $images
 * @property ProductImage $mainImage
 * @property ProductDrawing[] $drawings
 * @property ClientPhoto[] $clientPhotos
 * @property ColourGroup[] $colourGroups
 * @property Modification[] $modifications
 * @property Value[] $values
 *
 * @mixin SeoBehavior
 * @mixin SaveRelationsBehavior
 */
class Product extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var Seo
     */
    private $seo;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SlugBehavior::class,
            SeoBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['images', 'drawings', 'clientPhotos', 'colourGroups', 'values'],
            ],
        ];
    }

    public static function create($title, $alias, $description, $categoryId, $gift, ?Seo $seo = null): Product
    {
        $product = new Product();
        $product->title = $title;
        $product->alias = $alias;
        $product->description = $description;
        $product->category_id = $categoryId;
        $product->gift = $gift;
        $product->status = self::STATUS_DRAFT;
        $product->is_popular = false;
        $product->seo = $seo ?? Seo::blank();

        return $product;
    }

    public function changeSeo(Seo $seo)
    {
        $this->seo = $seo;
    }

    public function edit($title, $alias, $description, $categoryId, $gift, Seo $seo)
    {
        $this->title = $title;
        $this->alias = $alias;
        $this->description = $description;
        $this->category_id = $categoryId;
        $this->gift = $gift;
        $this->seo = $seo;
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

    public function getSeo(): Seo
    {
        return $this->seo;
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
            'is_popular' => 'Популярный товар',
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

    public function beforeSave($insert)
    {
        $this->setAttribute('meta_t', $this->seo->getTitle());
        $this->setAttribute('meta_d', $this->seo->getDescription());
        $this->setAttribute('meta_k', $this->seo->getKeywords());
        $this->setAttribute('h1', $this->seo->getH1());
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->seo = new Seo(
            $this->getAttribute('meta_t'),
            $this->getAttribute('meta_d'),
            $this->getAttribute('meta_k'),
            $this->getAttribute('h1')
        );
        parent::afterFind();
    }

    public function addColourGroup(ColourGroup $group)
    {
        $groups = $this->colourGroups;
        $groups[] = $group;
        $this->colourGroups = $groups;
    }

    public function getColourGroups()
    {
        return $this->hasMany(ColourGroup::class, ['product_id' =>'id']);
    }

    public function getModifications()
    {
        return $this->hasMany(Modification::class, ['group_id' => 'id'])->via('colourGroups');
    }

    public function updateColourGroup($group_id, $title, $colourIds)
    {
        $groups = $this->colourGroups;

        foreach($groups as $colourGroup){
            if ($colourGroup->id == $group_id){
                $colourGroup->edit($title, $colourIds);
                $this->colourGroups = $groups;
                return;
            }
        }

        throw new \DomainException('Группа цветов не найдена');
    }

    public function deleteColourGroup($group_id)
    {
        $groups = $this->colourGroups;
        foreach($groups as $i => $group){
            if($group->id == $group_id){
                unset($groups[$i]);
                $this->colourGroups = $groups;
                return;
            }
        }
        throw new \DomainException('Группа цветов не найдена');
    }

    public function getModificationById($id)
    {
        foreach ($this->modifications as $modification) {
            if ($modification->id == $id) {
                return $modification;
            }
        }

        throw new \DomainException('Модификация не найдена');
    }

    public function setValue(Value $value)
    {
        $values = $this->values;
        foreach ($values as $i => $current) {
            if ($current->characteristic_id == $value->characteristic_id) {
                $values[$i] = $value;
                $this->values = $values;
                return;
            }
        }
        $values[] = $value;
        $this->values = $values;
    }

    public function getValues()
    {
        return $this->hasMany(Value::class, ['product_id' => 'id'])
            ->orderBy(['is_basic_set' => SORT_DESC]);
    }

    public function removeValue($valueId)
    {
        $values = $this->values;
        foreach ($values as $i => $value) {
            if ($value->id == $valueId) {
                unset($values[$i]);
                $this->values = $values;
                return;
            }
        }
        throw new \DomainException('Значение не найдено');
    }

    public function findValueByCharacteristic($characteristicId): ?Value
    {
        $values = $this->values;
        foreach ($values as $value) {
            if ($value->characteristic_id == $characteristicId) {
                return $value;
            }
        }
        return null;
    }
}
