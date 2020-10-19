<?php


namespace app\modules\faq\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * @property string $question [varchar(255)]
 * @property string $answer [varchar(255)]
 * @property string $id [varchar(255)]
 * @property string $status [varchar(255)]
 */

class QuestionSearch extends Model
{
    public $id;
    public $question;
    public $status;

    public function rules()
    {
        return [
            [['id', 'question', 'status'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Question::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'question', $this->question]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);
    }

    public function StatusDropDown()
    {
        return [0 => 'Неактивный', 1 => 'Активный'];
    }
}
