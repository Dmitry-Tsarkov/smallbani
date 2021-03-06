<?php

namespace app\modules\catalog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class ProductSearch extends Model
{
    public $id;
    public $is_popular;
    public $title;
    public $alias;
    public $status;
    public $category_id;

    public function rules()
    {
        return [
            [['title',  'alias', 'status', 'category_id', 'id', 'is_popular'], 'string'],
        ];
    }

    public function search(array $params): DataProviderInterface
    {
        $query = Product::find()->with('category');

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
                'category_id' => $this->category_id,
                'is_popular' => $this->is_popular
            ]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
    }

    public function categoriesDropDown()
    {
        return Category::find()->select('title')->indexBy('id')->column();
    }

}
