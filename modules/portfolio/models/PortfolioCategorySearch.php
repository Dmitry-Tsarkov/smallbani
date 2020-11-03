<?php


namespace app\modules\portfolio\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class PortfolioCategorySearch extends Model
{
    public $id;
    public $title;
    public $alias;

    public function rules()
    {
        return [
            [['id', 'title', 'alias',], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {

        $query = PortfolioCategory::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere([
                'id' => $this->id,
            ]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);

        }

        return new ActiveDataProvider([
            'query' => $query,

        ]);

    }

}



