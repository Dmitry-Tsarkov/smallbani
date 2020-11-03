<?php


namespace app\modules\portfolio\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class PortfolioSearch extends Model
{
    public $id;
    public $title;
    public $description;
    public $alias;
    public $status;
    public $category_id;

    public function rules()
    {
        return [
            [['id', 'title', 'description', 'alias', 'status', 'category_id'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Portfolio::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['category_id' => $this->category_id]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'description', $this->description]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function StatusDropDown()
    {
        return [0 => 'Неактивное', 1 => 'Активное'];
    }

    public function categoriesDropDown()
    {
        return PortfolioCategory::find()->select('title')->indexBy('id')->column();
    }

}
