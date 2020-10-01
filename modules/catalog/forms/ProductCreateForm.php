<?php

namespace app\modules\catalog\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\catalog\models\Category;

/**
 * @property PhotosForm $photos
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

    protected function internalForms(): array
    {
        return ['photos'];
    }
}