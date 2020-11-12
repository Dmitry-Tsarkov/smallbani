<?php

namespace app\modules\characteristic\models;

use app\modules\catalog\models\Product;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ValueSearch extends Model
{
    public $value;
    private $product;

    public function __construct(Product $product)
    {
        parent::__construct();
        $this->product = $product;
    }

    public function rules()
    {
        return [
            [['value'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = $this->product->getValues();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'value', $this->value]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
