<?php


namespace app\modules\catalog\readModels;


use app\modules\catalog\models\Category;

class CategoryReadRepository
{
    public function findByAlias($alias): ?Category
    {
        return Category::find()
            ->notRoot()
            ->andWhere(['alias' => $alias])
            ->limit(1)
            ->one();
    }

    /**
     * @return Category[]
     */
    public function getList(): array
    {
        return Category::find()
            ->alias('c')
            ->andWhere(['c.depth' => 1])
            ->orderBy('c.lft')
            ->groupBy('c.id')
            ->all();
    }

    /**
     * @param Category $category
     * @return Category[]
     */
    public function getTabs(Category $parent): array
    {
        return $parent->children(1)->all();
    }
}
