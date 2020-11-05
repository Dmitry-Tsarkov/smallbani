<?php


namespace app\modules\catalog\models;


use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @see Category
 *
 * @mixin NestedSetsQueryBehavior
 */
class CategoryQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::class,
        ];
    }

    public function notRoot()
    {
        return $this->andWhere(['>', 'depth', 0]);
    }
}
