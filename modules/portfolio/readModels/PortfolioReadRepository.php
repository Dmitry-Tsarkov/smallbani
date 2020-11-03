<?php


namespace app\modules\portfolio\readModels;

use app\modules\portfolio\models\PortfolioCategory;
use app\modules\portfolio\models\Portfolio;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class PortfolioReadRepository
{
    public function inCategory(PortfolioCategory $portfolio): ActiveDataProvider
    {
        $query = $portfolio
            ->getPortfolios()
            ->andWhere(['status' => Portfolio::STATUS_ACTIVE]);

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

    public function findByAlias($alias): ? Portfolio
    {
        return Portfolio::find()
            ->andWhere(['alias' => $alias])
            ->limit(1)
            ->one();
    }

    public function getList($categoryId = null): DataProviderInterface
    {
        $query = Portfolio::find()
            ->andWhere(['status' => 1])
            ->andFilterWhere(['category_id' => $categoryId]);


        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
                'pageSizeParam' => false
            ],
        ]);
    }

}
