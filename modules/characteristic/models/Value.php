<?php


namespace app\modules\characteristic\models;


use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;
use function Composer\Autoload\includeFile;

/**
 * @property int $id [int(11)]
 * @property int $characteristic_id [int(11)]
 * @property int $product_id [int(11)]
 * @property int $variant_id [int(11)]
 * @property string $value [varchar(255)]
 * @property string $is_basic_set [varchar(255)]
 *
 * @property Characteristic $characteristic
 * @property Variant $variant
 */

class Value extends ActiveRecord
{
    use QueryExceptions;

    public static function tableName()
    {
        return '{{characteristic_values}}';
    }

    public function getValue()
    {
        return !empty($this->variant_id) ? $this->variant_id : $this->value;
    }

    public function getBasicValue()
    {

        return $this->is_basic_set == 0 ?: $this->value;
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

    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::class, ['id' => 'characteristic_id']);
    }

    public function getText()
    {
        return !empty($this->variant_id) ? $this->variant->value : $this->value;
    }

    public function getVariant()
    {
        return $this->hasOne(Variant::class, ['id' => 'variant_id']);
    }
}
