<?php


namespace app\widgets;


use yii\base\Widget;

class BreadcrumbWidget extends Widget
{
    public $links = [];

    public function run()
    {
        $links = array_map(function($link) {
            if (is_array($link) && !empty($link['url'])) {
                $link['class'] = 'breadcrumb__link';
            }

            return $link;
        }, $this->links);

        return $this->render('breadcrumbs', ['links' => $links]);
    }
}
