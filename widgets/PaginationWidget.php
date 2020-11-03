<?php


namespace app\widgets;


use yii\base\Widget;
use yii\data\Pagination;

class PaginationWidget extends Widget
{
    /**
     * @var Pagination
     */
    public $pagination;

    public function run()
    {
        return $this->render('pagination', ['pagination' => $this->pagination]);
    }
}
