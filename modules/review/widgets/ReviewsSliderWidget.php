<?php


namespace app\modules\review\widgets;

use app\modules\review\readModels\ReviewReadRepository;
use yii\base\Widget;

class ReviewsSliderWidget extends Widget
{
    private $reviews;

    public function __construct(ReviewReadRepository $reviews, $config = [])
    {
        parent::__construct($config);
        $this->reviews = $reviews;
    }

    public function run()
    {
        $reviews = $this->reviews->getSlider();

        return $this->render('reviews_slider', compact('reviews'));
    }
}
