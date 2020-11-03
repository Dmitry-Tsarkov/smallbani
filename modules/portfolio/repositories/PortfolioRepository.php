<?php


namespace app\modules\portfolio\repositories;


use app\modules\portfolio\models\Portfolio;

class PortfolioRepository
{
    public function save(Portfolio $portfolio)
    {
        if(!$portfolio->save()) {
            throw new \RuntimeException('Portfolio saving error');
        }
    }

    public function getById($id): Portfolio
    {
        if (!$portfolio = Portfolio::findOne($id)) {
            throw new \DomainException('Портфолио не найдено');
        }

        return $portfolio;
    }

    public function delete(Portfolio $portfolio): void
    {
        if (!$portfolio->delete()) {
            throw new \DomainException('Portfolio deleting error');
        }
    }
}
