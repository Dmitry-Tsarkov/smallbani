<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\catalog\models\ProductSearch;

class ProductController extends BalletController
{
    public function actionIndex()
    {
        //метод find() вернет объект класса ActiveQuery,
        //ActiveQuery - запрос к базе данных, в нем хранится вся необходимая
        //итнформация о запросе, который нужно выполнить

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }
}