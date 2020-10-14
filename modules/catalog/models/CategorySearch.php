<?php

namespace app\modules\catalog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CategorySearch extends Model
{
    public $id;
    public $title;
    public $alias;
    public $status;

    public function rules()
    {
        return [
            [['id', 'title', 'alias', 'status'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Category::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere([
                'id'     => $this->id,
                'status' => $this->status,
            ]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);

        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);
    }
}