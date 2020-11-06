<?php

namespace app\modules\order\controllers;
use app\modules\catalog\models\Product;
use app\modules\order\forms\OrderForm;
use app\modules\order\models\Order;
use app\modules\order\services\OrderService;
use DomainException;
use RuntimeException;
use Yii;
use yii\web\Controller;

class FrontendController extends Controller
{
    private $orderService;

    public function __construct($id, $module, OrderService $orderService, $config = [])
    {
        $this->orderService = $orderService;
        parent::__construct($id, $module, $config);
    }

    public function actionTest($id)
    {
        $product = Product::getOrFail($id);
        $orderForm = new OrderForm();
        $orderForm->productId = $product->id;

        return $this->render('test', compact('orderForm', 'product'));
    }

    public function actionOrder()
    {
        $orderForm = new OrderForm();
        $errorMessage = 'Что-то пошло не так';

        if ($orderForm->load(Yii::$app->request->post()) && $orderForm->validate()) {
            try {
                $order = $this->orderService->create($orderForm);
                Yii::$app->session->setFlash('order_id', $order->id);
                return $this->redirect(['success']);
            } catch (DomainException $e) {
                $errorMessage = $e->getMessage();
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        Yii::$app->session->setFlash('error_order', $errorMessage);

        return $this->redirect(['error']);
    }

    public function actionSuccess()
    {
        if(!$orderId = Yii::$app->session->getFlash('order_id')) {
            return $this->goHome();
        }

        $order = Order::getOrFail($orderId);

        return $this->render('success', compact('order'));
    }

    public function actionError()
    {
        if(!$errorMessage = Yii::$app->session->getFlash('error_order')) {
            return $this->goHome();
        }

        return $this->render('error', compact('errorMessage'));
    }
}
