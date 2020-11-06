<?php


namespace app\modules\order\notifiers;


use app\modules\order\models\Order;
use Yii;
use yii\mail\MailerInterface;

class OrderNotifier
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notify(Order $order)
    {
        try {
            $this->mailer->compose('order/create', compact('order'))
                ->setSubject('Тема сообщения')
                ->send();
        } catch (\Throwable $e) {
            Yii::$app->errorHandler->logException($e);
        }

    }
}
