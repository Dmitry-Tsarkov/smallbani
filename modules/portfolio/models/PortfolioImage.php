<?php


namespace app\modules\portfolio\models;


use app\modules\admin\behaviors\ImageBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class Portfolio
 * @package app\modules\portfolio\models
 * @property int $id [int(11)]
 * @property int $portfolio_id [int(11)]
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 * @property int $position [int(11)]
 *
 * @mixin ImageBehavior
 */

class PortfolioImage extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => ImageBehavior::class,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                    'preview' => ['width' => 1170, 'height' => 482],
                    'view' => ['width' => 1170, 'height' => 420],
                ],
                'folder' => 'portfolio',
            ],
        ];
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public static function create(UploadedFile $file): self
    {
        $image = new self();
        $image->image = $file;
        return $image;
    }

    public static function tableName()
    {
        return 'portfolio_images';
    }
}
