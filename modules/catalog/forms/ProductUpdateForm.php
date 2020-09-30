<?php

namespace app\modules\catalog\forms;

use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;
use yii\base\Model;

class ProductUpdateForm extends Model
{
    public $title;
    public $alias;
    public $description;
    public $categoryId;

    public function __construct(Product $product)
    {
        $this->title = $product->title;
        $this->alias = $product->alias;
        $this->description = $product->description;
        $this->categoryId = $product->category_id;

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title', 'categoryId'], 'required'],
            [['title', 'alias', 'description'], 'string'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
            [['categoryId'], 'integer'],
        ];
    }

    public function getCategoriesDropDown()
    {
        return Category::find()->select('title')->indexBy('id')->column();
    }
}