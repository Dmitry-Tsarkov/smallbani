<?php


namespace app\modules\feedback\services;


use app\modules\feedback\forms\CallbackForm;
use app\modules\feedback\forms\FeedbackForm;
use app\modules\feedback\models\Feedback;

class FeedbackService
{
    private $mailer;
    private $feedbacks;

    public function __construct(FeedbackMailer $mailer, $feedbacks)
    {
        $this->mailer = $mailer;
        $this->feedbacks = $feedbacks;
    }

    public function callback(CallbackForm $form)
    {
        $feedback = Feedback::callback(
            $form->name,
            $form->phone
        );

        $this->feedbacks->save($feedback);
        $this->mailer->callback($feedback);
    }

    public function feedback(FeedbackForm $form)
    {
        $feedback = Feedback::feedback(
            $form->name,
            $form->email,
            $form->text
        );

        $this->feedbacks->save($feedback);
        $this->mailer->feedback($feedback);
    }
}
