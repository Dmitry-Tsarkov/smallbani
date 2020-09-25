<?php


namespace app\modules\catalog\models;

use app\modules\admin\behaviors\SlugBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property string $id
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property string $status
 * @property int $image [int(11)]
 * @property int $image_hash [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
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
}