<?php


namespace app\modules\review\repositories;


use app\modules\review\models\Review;
use DomainException;
use RuntimeException;

class ReviewRepository
{
    public function save(Review $review): void
    {
        if (!$review->save()) {
            throw new RuntimeException('Review saving error');
        }
    }

    public function getById($id): Review
    {
        if (!$review = Review::find()->andWhere(['id' => $id])->limit(1)->one()) {
            throw new DomainException('Searching error');
        }

        return $review;
    }

    public function delete(Review $review): void
    {
        if ($review->delete() === false) {
            throw new RuntimeException('Review deleting error');
        }
    }
}
