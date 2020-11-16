<?php


namespace app\modules\feedback\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class FeedbackCallbackSearch extends Model
{
    public $id;
    public $name;
    public $phone;
    public $type;
    public $status;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['name', 'phone', 'type'], 'string'],
            [['status'],'integer'],
        ];
    }

    public function search(array $params): DataProviderInterface
    {
        $query = Feedback::find()->andFilterWhere(['type'=>'callback']);

        if ($this->load($params) && $this->validate()){
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
            ]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'phone', $this->phone]);
            $query->andFilterWhere(['like', 'type', $this->type]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
