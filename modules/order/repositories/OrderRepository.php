<?php


namespace app\modules\order\repositories;


use app\modules\order\models\Order;

class OrderRepository
{
    public function save(Order $order)
    {
        if (!$order->save()) {
            throw new \RuntimeException('Order saving error');
        }
    }

    public function getById($id): Order
    {
        if (!$order = Order::find()->andWhere(['id' => $id])->limit(1)->one()) {
            throw new \DomainException('Заказ не найден');
        }

        return $order;
    }

    public function delete(Order $order)
    {
        if (!$order->delete()) {
            throw new \RuntimeException('Order deleting error');
        }
    }
}
