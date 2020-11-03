<?php


namespace app\modules\order\forms;

use app\modules\order\helpers\OrderHelper;
use app\modules\order\models\Order;
use yii\base\Model;

class OrderStatusForm extends Model
{
    public $status;

    public function __construct(Order $order)
    {
        $this->status = $order->status;
        parent::__construct();
    }

    public function rules()
    {
        return [
            ['status', 'integer'],
            ['status', 'in', 'range' => array_keys(OrderHelper::statusList()), 'message' => '']
        ];
    }

    public function getStatusesDropDown()
    {
        return OrderHelper::statusList();
    }
}
