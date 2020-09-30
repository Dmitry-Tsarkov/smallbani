<?php


namespace app\modules\catalog\models;

use app\modules\admin\behaviors\SlugBehavior;
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
 *
 * @property Category $category
 */
class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{catalog_products}}';
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
}