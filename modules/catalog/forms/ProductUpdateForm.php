<?php

namespace app\modules\catalog\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;
use app\modules\seo\forms\SeoForm;

/**
 * @property SeoForm $seo
 */
class ProductUpdateForm extends CompositeForm
{
    public $title;
    public $alias;
    public $description;
    public $categoryId;
    public $gift;

    public function __construct(Product $product)
    {
        $this->title = $product->title;
        $this->alias = $product->alias;
        $this->gift = $product->gift;
        $this->description = $product->description;
        $this->categoryId = $product->category_id;
        $this->seo = new SeoForm($product->getSeo());

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'alias', 'description', 'gift'], 'string'],
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
            'description' => 'Описание',
            'categoryId' => 'Категория',
            'gift' => 'Подарок',

        ];
    }

    public function getCategoriesDropDown()
    {
        return Category::find()->select('title')->indexBy('id')->column();
    }

    protected function internalForms(): array
    {
        return ['seo'];
    }
}
