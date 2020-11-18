<?php


namespace app\modules\feedback\services;


use app\modules\feedback\helpers\FeedbackHelper;
use app\modules\feedback\models\Feedback;
use Throwable;
use Yii;
use yii\mail\MailerInterface;

class FeedbackMailer
{

    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function callback(Feedback $feedback)
    {
        try {
            $this->mailer->compose('feedback/callback', compact('feedback'))
                ->setSubject('Заявка "' . FeedbackHelper::getTypeLabel(Feedback::TYPE_CALLBACK) . '"')
                ->send();
        } catch (Throwable $e) {
            Yii::$app->errorHandler->logException($e);
        }
    }

    public function feedback(Feedback $feedback)
    {
        try {
            $this->mailer->compose('feedback/feedback', compact('feedback'))
                ->setSubject('Сообщение с сайта')
                ->send();
        } catch (Throwable $e) {
            Yii::$app->errorHandler->logException($e);
        }
    }

    public function portfolio(Feedback $feedback)
    {
        try {
            $this->mailer->compose('feedback/portfolio', compact('feedback'))
                ->setSubject('Заказать такую же ')
                ->send();
        } catch (Throwable $e) {
            Yii::$app->errorHandler->logException($e);
        }
    }

    public function preview(Feedback $feedback)
    {
        try {
            $this->mailer->compose('feedback/preview', compact('feedback'))
                ->setSubject('Попасть на просмотр')
                ->send();
        } catch (Throwable $e) {
            Yii::$app->errorHandler->logException($e);
        }
    }
}
