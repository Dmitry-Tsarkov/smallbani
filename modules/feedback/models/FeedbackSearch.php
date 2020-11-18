<?php


namespace app\modules\feedback\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class FeedbackSearch extends Model
{

    public $id;
    public $name;
    public $email;
    public $text;
    public $type;
    public $status;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['name', 'email', 'text', 'type'], 'string'],
            [['status'],'integer'],
        ];
    }

    public function search(array $params): DataProviderInterface
    {
        $query = Feedback::find()->andFilterWhere(['type'=>'feedback']);

        if ($this->load($params) && $this->validate()){
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
            ]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'email', $this->email]);
            $query->andFilterWhere(['like', 'type', $this->type]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);
    }
}
