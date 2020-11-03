<?php


namespace app\modules\slide\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * @property string $title [varchar(255)]
 * @property string $id [varchar(255)]
 * * @property string $is_active [varchar(255)]
 */
class SlideSearch extends Model
{
    public $id;
    public $title;
    public $is_active;

    public function rules()
    {
        return [
            [['id', 'title', 'is_active'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Slide::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['is_active' => $this->is_active]);
            $query->andFilterWhere(['like', 'title', $this->title]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);
    }

    public function statusDropDown()
    {
        return [0 => 'Неактивный', 1 => 'Активный'];
    }
}
