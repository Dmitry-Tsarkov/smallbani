<?php


namespace app\modules\order\models;


use app\modules\order\helpers\OrderHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class OrderSearch extends Model
{
    public $id;
    public $product_id;
    public $phone;
    public $name;
    public $product_title;
    public $status;

    public function rules()
    {
       return([
           [['id', 'product_id', 'phone', 'name', 'product_title'], 'string'],
           [['status'], 'integer'],
       ]);
    }

    public function search(array $params): DataProviderInterface
    {
        $query = Order::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere([
                'id' => $this->id,
                'product_id' => $this->product_id,
                'status' => $this->status,
            ]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'phone', $this->phone]);
            $query->andFilterWhere(['like', 'product_title', $this->product_title]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);

    }

    public function getStatusesDropDown()
    {
        return OrderHelper::statusList();
    }
}
