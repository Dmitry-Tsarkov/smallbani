<?php


namespace app\modules\review\widgets;


use app\modules\review\models\Review;
use yii\base\Widget;

class ReviewWidget extends Widget
{
    /** @var Review */
    public $review;

    public function run()
    {
        return $this->render('review', [
            'review' => $this->review
        ]);
    }
}
