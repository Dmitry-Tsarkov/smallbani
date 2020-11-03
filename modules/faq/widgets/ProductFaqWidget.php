<?php


namespace app\modules\faq\widgets;


use app\modules\faq\readModels\QuestionReadRepository;
use yii\base\Widget;


class ProductFaqWidget extends Widget
{
    public $questions;

    public function __construct(QuestionReadRepository $questions, $config = [])
    {
        parent::__construct($config);
        $this->questions = $questions;
    }

    public function run()
    {
        $questions = $this->questions->getActive();
        return $this->render('productFaq', ['questions' => $questions]);
    }
}
