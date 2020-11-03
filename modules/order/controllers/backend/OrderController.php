<?php


namespace app\modules\order\controllers\backend;


use app\modules\admin\components\BalletController;
use app\modules\order\forms\OrderStatusForm;
use app\modules\order\models\Order;
use app\modules\order\models\OrderSearch;
use app\modules\order\services\OrderManageService;
use DomainException;
use RuntimeException;
use Yii;

class   OrderController extends BalletController
{
    public $service;

    public function __construct($id, $module, OrderManageService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionView($id)
    {
        $order = Order::getOrFail($id);
        $statusForm = new OrderStatusForm($order);

        return $this->render('view', compact('order', 'statusForm'));
    }

    public function actionChangeStatus($id)
    {
        $order = Order::getOrFail($id);
        $statusForm = new OrderStatusForm($order);
        if ($statusForm->load(Yii::$app->request->post()) && $statusForm->validate()) {
            try {
                $this->service->changeStatus($order->id, $statusForm);
                Yii::$app->session->setFlash('success', 'Статус изменен');
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->session->setFlash('error', 'Техническая ошибка');
                Yii::$app->errorHandler->logException($e);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDelete($id)
    {
        try{
            $this->service->delete($id);
            Yii::$app->session->setFlash('success', 'Заказ удален');

            return $this->redirect(['index']);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (RuntimeException $e) {
            Yii::$app->session->setFlash('error', 'Техническая ошибка');
            Yii::$app->errorHandler->logException($e);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}
