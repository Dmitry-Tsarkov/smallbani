<?php

namespace app\modules\characteristic\models;

use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property int $characteristic_id [int(11)]
 * @property string $value [varchar(255)]
 */

class Variant extends ActiveRecord
{
    public static function tableName()
    {
        return '{{characteristic_variants}}';
    }

    public static function create($characteristicId, $value): Variant
    {
        $variant = new Variant();
        $variant->value = $value;
        $variant->characteristic_id = $characteristicId;

        return $variant;
    }

    public function edit($value)
    {
        $this->value = $value;
    }

}
