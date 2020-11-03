<?php


namespace app\modules\catalog\models;

use app\modules\admin\behaviors\ImageBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii2tech\ar\position\PositionBehavior;


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
class ProductDrawing extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => ImageBehavior::class,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                    'preview' => ['width' => 270, 'height' => 210],
                    'view' => ['width' => 1170, 'height' => 420],
                ],
                'folder' => 'product',
            ],
        ];
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public static function create(UploadedFile $file): ProductDrawing
    {
        $image = new self();
        $image->image = $file;
        return $image;
    }

    public static function tableName()
    {
        return 'catalog_product_drawings';
    }
}
