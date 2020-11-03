<?php

namespace app\modules\seo\forms;

use app\modules\seo\valueObjects\Seo;
use yii\base\Model;

class SeoForm extends Model
{
    public $title;
    public $description;
    public $keywords;
    public $h1;

    public function __construct(?Seo $seo = null)
    {
        if ($seo) {
            $this->title = $seo->getTitle();
            $this->description = $seo->getDescription();
            $this->keywords = $seo->getKeywords();
            $this->h1 = $seo->getH1();
        }

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title', 'description', 'keywords', 'h1'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок страницы',
            'description' => 'Описание страницы',
            'keywords' => 'Ключевые слова',
            'h1' => 'H1',
        ];
    }
}
