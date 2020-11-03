<?php


namespace app\modules\order\models;


use app\modules\admin\traits\QueryExceptions;
use app\modules\catalog\models\Product;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property int $product_id [int(11)]
 * @property string $phone [varchar(255)]
 * @property string $name [varchar(255)]
 * @property string $product_title [varchar(255)]
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 *
 * @property OrderModification[] $orderModifications
 */
class Order extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_NEW = 1;
    const STATUS_PROCESS = 2;
    const STATUS_DONE = 3;
    const STATUS_DELETE = 4;


    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'orderModifications'
                ],
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'name' => 'Имя заказчика',
            'product_title' => 'Наименование товара',
            'product_id' => 'Id товара',
            'status' => 'Статус'
        ];
    }

    public static function create($name, $phone, Product $product, $modificationIds): Order
    {
        $order = new Order();
        $order->name = $name;
        $order->phone = $phone;
        $order->product_id = $product->id;
        $order->product_title = $product->title;
        $order->created_at = time();
        $order->updated_at = time();
        $order->orderModifications = array_map(function ($id) use ($product) {
            return OrderModification::create(
                $product->getModificationById($id)
            );
        }, $modificationIds);
        $order->status = self::STATUS_NEW;

        return $order;
    }

    public function changeStatus($status)
    {
        $this->status = $status;
        $this->updated_at = time();
    }

    public static function tableName()
    {
        return 'orders';
    }

    public function getOrderModifications()
    {
        return $this->hasMany(OrderModification::class, ['order_id' => 'id']);
    }

    public function isDelete(): bool
    {
        return $this->status === Order::STATUS_DELETE;
    }
}
