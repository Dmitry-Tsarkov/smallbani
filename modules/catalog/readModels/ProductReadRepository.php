<?php


namespace app\modules\catalog\readModels;

use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class ProductReadRepository
{
    public function inCategory(Category $category): DataProviderInterface
    {
        $categoryIds = $category->children()->select('id')->column();
        $categoryIds[] = $category->id;

        $query = Product::find()
            ->andWhere(['category_id' => $categoryIds])
            ->andWhere(['status' => Product::STATUS_ACTIVE]);

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

    /**
     * @return Product[]
     */
    public function getPopular(): array
    {
        return Product::find()
            ->andWhere(['is_popular'=> 1])
            ->limit(8)
            ->andWhere(['status' => Product::STATUS_ACTIVE])
            ->all();
    }

    public function findByAlias($alias): ?Product
    {
        return Product::find()
            ->andWhere(['alias' => $alias])
            ->limit(1)
            ->one();
    }
}
