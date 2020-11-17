<?php


namespace app\modules\feedback\repositories;


use app\modules\feedback\models\Feedback;
use DomainException;
use http\Exception\RuntimeException;

class FeedbackRepository
{
    public function save(Feedback $feedback)
    {
        if (!$feedback->save()){
            throw new RuntimeException('Feedback saving error');
        }
    }

    public function delete(Feedback $feedback): void
    {
        if (!$feedback->delete()){
            throw new DomainException('Feedback deleting error');
        }
    }

    public function getById($id): Feedback
    {
        if (!$feedback = Feedback::findOne($id)) {
            throw new \DomainException('Заявка не найдена');
        }
        return $feedback;
    }
}
