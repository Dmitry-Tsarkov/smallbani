<?php

namespace app\modules\catalog\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;

/**
 * @property PhotosForm $photos
 * @property PhotosForm $drawings
 */
class ProductCreateForm extends CompositeForm
{
    public $title;
    public $alias;
    public $description;
    public $categoryId;


    public function __construct()
    {
        $this->photos = new PhotosForm();
        $this->drawings = new DrawingsForm();
        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'alias', 'description'], 'string'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
            [['categoryId'], 'integer'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'status' => 'Статус',
            'alias' => 'Алиас',
            'categoryId' => 'Категория',
            'description' => 'Описание',
        ];
    }

    public function getCategoriesDropDown()
    {
        return Category::find()->select('title')->indexBy('id')->column();
    }

    protected function internalForms(): array
    {
        return ['photos', 'drawings'];
    }
}
