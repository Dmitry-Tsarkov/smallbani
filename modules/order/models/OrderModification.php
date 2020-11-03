<?php


namespace app\modules\order\models;


use app\modules\catalog\models\Modification;
use yii\db\ActiveRecord;

/**
 * Class OrderModification
 * @package app\modules\order\models
 * @property int $id [int(11)]
 * @property int $order_id [int(11)]
 * @property int $modification_id [int(11)]
 * @property string $modification_title [varchar(255)]
 * @property string $modification_colour_title [varchar(255)]
 * @property string $modification_colour_hex [varchar(255)]
 */
class OrderModification extends ActiveRecord
{
    public static function create(Modification $modification): self
    {
        $item = new self();
        $item->modification_id = $modification->id;
        $item->modification_title = $modification->group->title;
        $item->modification_colour_title = $modification->colour->title;
        $item->modification_colour_hex = $modification->colour->hex;
        return $item;
    }

    public static function tableName()
    {
        return 'order_modifications';
    }


}
