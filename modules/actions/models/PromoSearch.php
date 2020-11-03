<?php


namespace app\modules\actions\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class PromoSearch extends Model
{
    public $id;
    public $title;
    public $description;
    public $alias;
    public $is_relevant;
    public $status;

    public function rules()
    {
        return [
            [['id', 'title', 'description', 'alias', 'is_relevant', 'status'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Promo::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['is_relevant' => $this->is_relevant]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'description', $this->description]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function isRelevantDropDown()
    {
        return [0 => 'Неактуальная', 1 => 'Актуальная'];
    }

    public function StatusDropDown()
    {
        return [0 => 'Неактивный', 1 => 'Активный'];
    }
}
