<?php


namespace app\modules\characteristic\models;


use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property int $characteristic_id [int(11)]
 * @property int $product_id [int(11)]
 * @property int $variant_id [int(11)]
 * @property string $value [varchar(255)]
 * @property string $is_basic_set [varchar(255)]
 */

class Value extends ActiveRecord
{
    public static function tableName()
    {
        return '{{characteristic_values}}';
    }

    public static function createValue($characteristicId, $value, $is_basic_set): Value
    {
        $self = new Value();
        $self->value = $value;
        $self->characteristic_id = $characteristicId;
        $self->is_basic_set = $is_basic_set;

        return $self;
    }

    public static function createVariant($characteristicId, $variantId, $is_basic_set): Value
    {
        $CharacteristicValue = new Value();
        $CharacteristicValue->characteristic_id = $characteristicId;
        $CharacteristicValue->variant_id = $variantId;
        $CharacteristicValue->is_basic_set = $is_basic_set;

        return $CharacteristicValue;
    }
}
