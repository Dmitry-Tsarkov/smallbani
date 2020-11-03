<?php


namespace app\modules\review\models;


use app\modules\admin\behaviors\ImageBehavior;
use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property int $id [int(11)]
 * @property int $type [int(11)]
 * @property string $name [varchar(255)]
 * @property string $place [varchar(255)]
 * @property string $review
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $product_id [int(11)]
 * @property int $portfolio_id [int(11)]
 *
 * @mixin ImageBehavior
 */

class Review extends ActiveRecord
{
    use QueryExceptions;

    const TYPE_COMMON = 0;
    const TYPE_PRODUCT = 1;
    const TYPE_PORTFOLIO = 2;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => ImageBehavior::class,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                    'preview' => ['width' => 370, 'height' => 370],
                    'view' => ['width' => 1170, 'height' => 400],
                ],
                'folder' => 'review'
            ],
        ];
    }

    public static function create($name, $place, $review, $status): self
    {
        $self = new self();
        $self->name = $name;
        $self->place = $place;
        $self->review = $review;
        $self->status = $status;
        $self->type = self::TYPE_COMMON;
        $self->created_at = time();
        $self->updated_at = time();
        return $self;
    }

    public static function createForProduct($productId, $name, $place, $review, $status): self
    {
        $self = new self();
        $self->name = $name;
        $self->place = $place;
        $self->review = $review;
        $self->status = $status;
        $self->type = self::TYPE_PRODUCT;
        $self->product_id = $productId;
        $self->created_at = time();
        $self->updated_at = time();
        return $self;
    }

    public static function createForPortfolio($portfolioId, $name, $place, $review, $status): self
    {
        $self = new self();
        $self->name = $name;
        $self->place = $place;
        $self->review = $review;
        $self->status = $status;
        $self->type = self::TYPE_PORTFOLIO;
        $self->portfolio_id = $portfolioId;
        $self->created_at = time();
        $self->updated_at = time();
        return $self;
    }

    public function changePhoto(UploadedFile $file)
    {
        $this->image = $file;
    }

    public function edit($name, $place, $review, $status)
    {
        $this->name = $name;
        $this->place = $place;
        $this->review = $review;
        $this->status = $status;
        $this->updated_at = time();
    }

    public function isCommon()
    {
        return $this->type == self::TYPE_COMMON;
    }

    public function isProduct()
    {
        return $this->type == self::TYPE_PRODUCT;
    }

    public function isPortfolio()
    {
        return $this->type == self::TYPE_PORTFOLIO;
    }

    public static function tableName()
    {
        return 'reviews';
    }

    public function attributeLabels()
    {
        return [
            'name'   => 'ФИО',
            'place'  => 'Место',
            'review' => 'Отзыв',
            'image'  => 'Аватар',
            'status' => 'Статус',
            'type'   => 'К чему относится отзыв'
        ];
    }

}
