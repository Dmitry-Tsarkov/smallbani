<?php


namespace app\modules\actions\readModels;


use app\modules\actions\models\Promo;

class PromoReadRepository
{
    /**
     * @return Promo[]
     *
     */
    public function getRelevant(): array
    {
        return Promo::find()
            ->andWhere(['is_relevant'=> 1])
            ->limit(3)
            ->andWhere(['status' => 1])
            ->all();
    }

}
