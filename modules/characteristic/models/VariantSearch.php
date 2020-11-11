<?php

namespace app\modules\characteristic\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class VariantSearch extends Model
{
    public $value;
    private $characteristic;

    public function __construct(Characteristic $characteristic)
    {
        parent::__construct();
        $this->characteristic = $characteristic;
    }

    public function rules()
    {
        return [
            [['value'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = $this->characteristic->getVariants();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'value', $this->value]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
