<?php

namespace app\modules\actions\models;

use app\modules\admin\behaviors\ImageBehavior;
use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\seo\behaviors\SeoBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yiidreamteam\upload\ImageUploadBehavior;


/**
 * @property string $id
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property int $image [int(11)]
 * @property int $image_hash [int(11)]
 * @property string $description
 * @property int $status [int(11)]
 * @property int $is_relevant [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 *
 * @mixin ImageBehavior
 */

class Promo extends ActiveRecord
{
    use QueryExceptions;

    public static function tableName()
    {
        return '{{promos}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SlugBehavior::class,
            SeoBehavior::class,
            'image' => [
                'class' => ImageBehavior::class,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                    'preview' => ['width' => 370, 'height' => 370],
                    'view' => ['width' => 1170, 'height' => 400],
                ],
                'folder' => 'action'
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title', 'alias', 'description'], 'string'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
            [['status', 'is_relevant'], 'integer'],
            [['status'], 'in', 'range' => [0, 1], 'message' => 'Некорректный статус'],
            ['image', 'image', 'extensions' => 'jpeg, png, jpg'],
            [['meta_d', 'meta_k', 'meta_t', 'h1'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'       => 'Заголовок',
            'alias'       => 'Алиас',
            'image'       => 'Картинка',
            'description' => 'Описание акции',
            'status'      => 'Статус',
            'is_relevant' => 'Тип акции',
            'meta_t'      => 'Заголовок страницы',
            'meta_d'      => 'Описание страницы',
            'meta_k'      => 'Ключевые слова'
        ];
    }

    public function getHref()
    {
        return Url::to(['/actions/frontend/view', 'alias' => $this->alias]);
    }
}
