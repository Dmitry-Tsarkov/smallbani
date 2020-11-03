<?php


namespace app\modules\colour\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class ColourSearch extends Model
{
    public $id;
    public $title;
    public $hex;

    public function rules()
    {
        return [
            [['id', 'title', 'hex'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Colour::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere([
                'id'     => $this->id,
            ]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'hex',   $this->hex]);

        }

        return new ActiveDataProvider([
            'query' => $query,
//            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);
    }

}
