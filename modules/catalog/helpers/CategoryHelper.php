<?php


namespace app\modules\catalog\helpers;


use app\modules\catalog\models\Category;

class CategoryHelper
{
    public static function categoriesDropDown($id = null)
    {
        return Category::find()
            ->andWhere(['<=', 'depth', 1])
            ->select('title')
            ->indexBy('id')
            ->orderBy('lft')
            ->andFilterWhere(['not', ['id' => $id]])
            ->column();
    }
}
