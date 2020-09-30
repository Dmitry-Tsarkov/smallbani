<?php

namespace app\modules\catalog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProductSearch extends Model
{
    public $id;
    public $title;
    public $alias;
    public $status;
    public $category_id;

    public function rules()
    {
        return [
            [['title',  'alias', 'status', 'category_id', 'id'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Product::find()->with('category');

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
                'category_id' => $this->category_id
            ]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
    }
}