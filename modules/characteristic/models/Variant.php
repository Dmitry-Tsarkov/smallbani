<?php

namespace app\modules\characteristic\models;

use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property int $characteristic_id [int(11)]
 * @property string $value [varchar(255)]
 */

class Variant extends ActiveRecord
{

    use QueryExceptions;

    public static function tableName()
    {
        return '{{characteristic_variants}}';
    }

    public function attributeLabels()
    {
        return [
            'value' => 'Значение',
        ];
    }

    public static function create($characteristicId, $value): Variant
    {
        $variant = new Variant();
        $variant->value = $value;
        $variant->characteristic_id = $characteristicId;

        return $variant;
    }

    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::class, ['id' => 'characteristic_id']);
    }

    public function edit($value)
    {
        $this->value = $value;
    }
}
