<?php


namespace app\modules\portfolio\repositories;


use app\modules\portfolio\models\PortfolioCategory;

class PortfolioCategoryRepository
{
    public function getById($id): PortfolioCategory
    {
        if (!$category = PortfolioCategory::find()->andWhere(['id' => $id])->limit(1)->one()) {
            throw new \DomainException('Категория не найдена');
        }

        return $category;
    }
}
