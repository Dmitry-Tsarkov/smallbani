<?php


namespace app\modules\order\helpers;


use app\modules\order\models\Order;

class OrderHelper
{
    public static function statusList()
    {
        return [
            Order::STATUS_NEW => 'Новый',
            Order::STATUS_PROCESS => 'В обработке',
            Order::STATUS_DONE => 'Выполнен',
            Order::STATUS_DELETE => 'Помечен на удаление',
        ];
    }

    public static function statusLabel($status)
    {
        return self::statusList()[$status] ?? '-';
    }

    public static function statusLabelHtml($status)
    {
        if ($status === Order::STATUS_NEW) {
            return '<span class="label label-danger">Новый</span>';
        }
        if ($status === Order::STATUS_PROCESS) {
            return '<span class="label label-warning">В обработке</span>';
        }
        if ($status === Order::STATUS_DONE) {
            return '<span class="label label-success">Выполнен</span>';
        }
        return '<span class="label label-default">Помечен на удаление</span>';
    }
}
