<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $categories = Category::find()->all();
        return $this->render('index', compact('categories'));
    }

    public function actionCategory($alias)

    {
        $category = Category::find()->andWhere(['alias' => $alias])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => $category->getProducts(),
            'pagination' => [
                'pageSize' => 1,
            ],
        ]);

        return $this->render('category', compact('category', 'dataProvider'));
    }
}
