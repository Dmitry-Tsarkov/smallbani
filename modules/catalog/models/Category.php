<?php


namespace app\modules\catalog\models;

use app\modules\admin\behaviors\SlugBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property string $id
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property string $status
 * @property int $image [int(11)]
 * @property int $image_hash [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 *
 * @mixin ImageUploadBehavior
 */
class Category extends ActiveRecord
{
    public static function tableName()
    {
        return '{{catalog_categories}}';
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SlugBehavior::class,
            'image' => [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                ],
                'filePath'  => '@webroot/uploads/category/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'fileUrl'   => '/uploads/category/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/category/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
                'thumbUrl'  => '/uploads/cache/category/[[pk]]_[[profile]]_[[attribute_image_hash]].[[extension]]',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'alias'], 'string'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
            ['status', 'integer'],
            ['status', 'in', 'range' => [0, 1], 'message' => 'Некоректный статус'],
            ['image', 'image', 'extensions' => 'jpeg, gif, png, jpg'],

        ];
    }
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'status' => 'Статус',
            'alias' => 'Алиас',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->image instanceof UploadedFile) {
            $this->image_hash = uniqid();
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function deleteImage()
    {
        /** @var ImageUploadBehavior $imageBehavior */
        $imageBehavior = $this->getBehavior('image');
        $imageBehavior->cleanFiles();
        $this->updateAttributes([
            'image' => null,
            'image_hash' => null,
        ]);
    }

    public function hasImage()
    {
        return !empty($this->image) && is_file($this->getUploadedFilePath('image'));
    }
}