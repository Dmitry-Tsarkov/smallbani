<?php


namespace app\modules\catalog\models;

use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

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