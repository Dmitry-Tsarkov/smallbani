<?php

namespace app\modules\actions\controllers;

use app\modules\actions\models\Promo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Promo::find()->andWhere(['status' => 1]),
        ]);
        return $this->render('index', compact('dataProvider'));
    }

    public function actionView($alias)
    {
        $action = Promo::find()->andWhere(['alias' => $alias])->one();

        return $this->render('action', compact('action'));
    }
}
