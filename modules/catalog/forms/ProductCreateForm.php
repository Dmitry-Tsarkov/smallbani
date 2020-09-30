<?php

namespace app\modules\catalog\forms;

use app\modules\catalog\models\Category;
use yii\base\Model;

class ProductCreateForm extends Model
{
    public $title;
    public $alias;
    public $description;
    public $categoryId;

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