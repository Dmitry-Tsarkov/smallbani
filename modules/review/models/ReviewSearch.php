<?php


namespace app\modules\review\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ReviewSearch extends Model
{
    public $id;
    public $status;
    public $type;
    public $name;
    public $review;
    public $place;

    public function rules()
    {
        return [
            [['name', 'place', 'review', 'id', 'status', 'type'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Review::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['type' => $this->type]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'review', $this->review]);
            $query->andFilterWhere(['like', 'place', $this->place]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at'=>SORT_DESC]],
        ]);
    }

    public function StatusDropDown()
    {
        return [0 => 'Неактивный', 1 => 'Активный'];
    }

    public function TypeDropDown()
    {
        return [0 => 'Общие отзывы', 1 => 'Отзыв продукта', 2 => 'Отзыв портфолио',];
    }

}
