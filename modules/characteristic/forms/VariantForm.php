<?php

namespace app\modules\characteristic\forms;

use app\modules\characteristic\models\Variant;
use yii\base\Model;

class VariantForm extends Model
{
    public $value;

    public function __construct(Variant $variant = null)
    {
        if ($variant) {
            $this->value = $variant->value;
        }

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'value' => 'Значение',
        ];
    }
}
