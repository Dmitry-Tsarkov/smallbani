<?php

namespace app\modules\catalog\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\catalog\models\Category;
use app\modules\seo\forms\SeoForm;

/**
 * @property PhotosForm $photos
 * @property DrawingsForm $drawings
 * @property ClientPhotosForm $client
 * @property SeoForm $seo
 */
class ProductCreateForm extends CompositeForm
{
    public $title;
    public $alias;
    public $description;
    public $categoryId;
    public $gift;


    public function __construct()
    {
        $this->photos = new PhotosForm();
        $this->drawings = new DrawingsForm();
        $this->client = new ClientPhotosForm();
        $this->seo = new SeoForm();
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
            'categoryId' => 'Категория',
            'description' => 'Описание',
            'gift' => 'Подарок',
        ];
    }

    public function getCategoriesDropDown()
    {
        return Category::find()->select('title')->indexBy('id')->column();
    }

    protected function internalForms(): array
    {
        return ['photos', 'drawings', 'client', 'seo'];
    }
}
