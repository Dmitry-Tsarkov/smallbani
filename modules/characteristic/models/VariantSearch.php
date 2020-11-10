<?php


namespace app\modules\characteristic\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class VariantSearch extends Model
{
    public $value;

    public function rules()
    {
        return [
            [['value'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Variant::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'value', $this->value]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

}
