<?php


namespace app\modules\order\services;


use app\modules\catalog\repositories\ProductRepository;
use app\modules\order\forms\OrderForm;
use app\modules\order\models\Order;
use app\modules\order\notifiers\OrderNotifier;
use app\modules\order\repositories\OrderRepository;

class OrderService
{
    private $products;
    private $orders;
    private $notifier;

    public function __construct(ProductRepository $products, OrderRepository $orders, OrderNotifier $notifier)
    {
        $this->products = $products;
        $this->orders = $orders;
        $this->notifier = $notifier;
    }

    public function create(OrderForm $form): Order
    {
        $product = $this->products->getById($form->productId);

        $order = Order::create(
            $form->name,
            $form->phone,
            $product,
            $form->modificationIds
        );
        $this->orders->save($order);
        $this->notifier->notify($order);

        return $order;
    }
}
