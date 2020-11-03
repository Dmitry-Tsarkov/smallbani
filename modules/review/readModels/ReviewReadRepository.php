<?php


namespace app\modules\review\readModels;


use app\modules\portfolio\models\Portfolio;
use app\modules\review\models\Review;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class ReviewReadRepository
{
    public function getList() : DataProviderInterface
    {
        $query = Review::find()
            ->andWhere(['status' => 1])
            ->orderBy(['created_at'=>SORT_DESC]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
                'pageSizeParam' => false,
            ]
        ]);
    }

    /**
     * @param Portfolio $portfolio
     * @return Review[]
     */
    public function forPortfolio(Portfolio $portfolio): array
    {
        return $portfolio->getReviews()
            ->andWhere(['status' => 1])
            ->all();
    }

    /**
     * @return Review[]
     */
    public function getSlider(): array
    {
        return Review::find()
            ->andWhere(['status' => 1])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(10)
            ->all();
    }
}
