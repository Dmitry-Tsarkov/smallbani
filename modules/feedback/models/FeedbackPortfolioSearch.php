<?php

namespace app\modules\feedback\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class FeedbackPortfolioSearch extends Model
{
    public $id;
    public $name;
    public $portfolioTitle;
    public $portfolioId;
    public $phone;
    public $type;
    public $status;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['name', 'portfolioTitle', 'phone', 'type'], 'string'],
            [['status'],'integer'],
        ];
    }

    public function search(array $params): DataProviderInterface
    {
        $query = Feedback::find()->andFilterWhere(['type'=>'portfolio']);

        if ($this->load($params) && $this->validate()){
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
            ]);
            $query->andFilterWhere(['like', 'type', $this->type]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'portfolioTitle', $this->portfolioTitle]);
            $query->andFilterWhere(['like', 'phone', $this->phone]);
        }

        return new ActiveDataProvider([
          'query' => $query,
        ]);
    }

}
