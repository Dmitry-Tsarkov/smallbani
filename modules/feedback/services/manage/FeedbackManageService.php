<?php


namespace app\modules\feedback\services\manage;


use app\modules\feedback\models\FeedbackStatus;
use app\modules\feedback\repositories\FeedbackRepository;

class FeedbackManageService
{
    private $feedbacks;

    public function __construct(FeedbackRepository $feedbacks)
    {
        $this->feedbacks = $feedbacks;
    }

    public function changeStatus($id, $status)
    {
        $feedback = $this->feedbacks->getById($id);
        $feedback->changeStatus(
            new FeedbackStatus($status)
        );
        $this->feedbacks->save($feedback);
    }
}
