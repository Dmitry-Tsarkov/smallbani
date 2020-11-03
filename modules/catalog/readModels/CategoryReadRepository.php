<?php


namespace app\modules\catalog\readModels;


use app\modules\catalog\models\Category;

class CategoryReadRepository
{
    public function findByAlias($alias): ?Category
    {
        return Category::find()->andWhere(['alias' => $alias])->one();
    }
}
