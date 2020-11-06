<?php


namespace app\modules\order\services;


use app\modules\catalog\repositories\ProductRepository;
use app\modules\order\forms\OrderStatusForm;
use app\modules\order\repositories\OrderRepository;

class OrderManageService
{
    private $products;
    private $orders;

    public function __construct(ProductRepository $products, OrderRepository $orders)
    {
        $this->products = $products;
        $this->orders = $orders;
    }


    public function changeStatus($id, OrderStatusForm $form)
    {
        $order = $this->orders->getById($id);
        $order->changeStatus($form->status);
        $this->orders->save($order);
    }

    public function delete($id)
    {
        $order = $this->orders->getById($id);
        if (!$order->isDelete()) {
            throw new \DomainException('Удалять можно только помеченные на удаление');
        }
        $this->orders->delete($order);
    }
}
