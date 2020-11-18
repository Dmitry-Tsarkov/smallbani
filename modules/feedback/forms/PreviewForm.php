<?php


namespace app\modules\feedback\forms;


use app\modules\feedback\validators\PhoneValidator;
use yii\base\Model;

class PreviewForm extends Model
{
    public $phone;
    public $name;
    public $productId;
    public $portfolioId;

    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['name', 'phone'], 'string'],
            [['portfolioId', 'productId'], 'integer'],
            ['phone', PhoneValidator::class]
        ];
    }
}
