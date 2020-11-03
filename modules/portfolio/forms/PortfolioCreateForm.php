<?php

namespace app\modules\portfolio\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\admin\helpers\YoutubeHelper;
use app\modules\portfolio\models\PortfolioCategory;
use app\modules\seo\forms\SeoForm;


/**
 * @property PhotosForm $photos
 * @property SeoForm $seo
 */
class PortfolioCreateForm extends CompositeForm
{
    public $title;
    public $alias;
    public $description;
    public $categoryId;
    public $youtube_url;


    public function __construct()
    {
        $this->photos = new PhotosForm();
        $this->seo = new SeoForm();
        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title', 'categoryId'], 'required'],
            [['title', 'alias', 'description', 'youtube_url'], 'string'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
            [['categoryId'], 'integer'],
            ['youtube_url', 'validateYoutube'],
        ];
    }

    public function validateYoutube($attribute, $params)
    {
        if (empty($this->$attribute)) {
            return;
        }

        $id = YoutubeHelper::id($this->$attribute);

        if (empty($id)) {
            $this->addError($attribute, 'Некорректная ссылка на youtube видео');
        }
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'status' => 'Статус',
            'alias' => 'Алиас',
            'categoryId' => 'Категория',
            'description' => 'Описание',
            'youtube_url' => 'Ссылка на видео',
        ];
    }

    public function getCategoriesDropDown()
    {
        return PortfolioCategory::find()->select('title')->indexBy('id')->column();
    }

    protected function internalForms(): array
    {
        return ['photos', 'seo'];
    }
}
