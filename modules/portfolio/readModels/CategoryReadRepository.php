<?php


namespace app\modules\portfolio\readModels;


use app\modules\portfolio\models\PortfolioCategory;
use yii\db\ActiveQuery;

class CategoryReadRepository
{
    /**
     * @return PortfolioCategory[]
     */
    public function getCategories(): array
    {
        return PortfolioCategory::find()
            ->alias('c')
            ->innerJoinWith(['portfolios p' => function(ActiveQuery $q) {
                return $q->andWhere(['p.status' => 1]);
            }])
            ->groupBy('c.id')
            ->all();
    }

    public function findByAlias($alias): ?PortfolioCategory
    {
        return PortfolioCategory::find()->andWhere(['alias' => $alias])->one();
    }
}
