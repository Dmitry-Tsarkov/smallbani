<?php


namespace app\modules\catalog\models;

use app\modules\admin\behaviors\ImageBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii2tech\ar\position\PositionBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property int $id [int(11)]
 * @property int $product_id [int(11)]
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 * @property int $position [int(11)]
 *
 * @mixin PositionBehavior
 * @mixin ImageBehavior
 */
class ProductImage extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => ImageBehavior::class,
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                ],
                'folder' => 'product',
            ],
        ];
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public static function create(UploadedFile $file): ProductImage
    {
        $image = new self();
        $image->image = $file;
        return $image;
    }

    public static function tableName()
    {
        return 'catalog_product_images';
    }
}