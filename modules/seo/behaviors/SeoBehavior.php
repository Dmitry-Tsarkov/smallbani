<?php

namespace app\modules\seo\behaviors;

use app\modules\seo\valueObjects\Seo;
use Yii;
use yii\base\Behavior;

class SeoBehavior extends Behavior
{
    /** @var Seo */
    public $seo;

    public $titleAttribute = 'title';

    public function getMetaTag($tag)
    {
        switch ($tag) {
            case 'meta_t':
                return $this->owner->meta_t
                    ? $this->owner->meta_t
                    : $this->owner->{$this->titleAttribute};
            case 'meta_d':
                return $this->owner->meta_d
                    ? $this->owner->meta_d
                    : $this->owner->{$this->titleAttribute};
            case 'meta_k':
                return $this->owner->meta_k
                    ? $this->owner->meta_k
                    : $this->owner->{$this->titleAttribute};
            default:
                return $this->owner->{$this->titleAttribute};
        }
    }

    public function generateMetaTags()
    {
        Yii::$app->controller->view->title = $this->getMetaTag('meta_t');
        Yii::$app->controller->view->registerMetaTag(['name' => 'description', 'content' => $this->getMetaTag('meta_d')]);
        Yii::$app->controller->view->registerMetaTag(['name' => 'keywords', 'content' => $this->getMetaTag('meta_k')]);
    }

    /**
     * @return string
     */

    public function getH1()
    {
        return $this->owner->h1 ? $this->owner->h1 : $this->owner->{$this->titleAttribute};
    }
}
