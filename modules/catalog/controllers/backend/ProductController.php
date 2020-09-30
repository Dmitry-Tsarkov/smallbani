<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductSearch;
use yii\web\NotFoundHttpException;

class ProductController extends BalletController
{
    public function actionIndex()
    {
        //метод find() вернет объект класса ActiveQuery,
        //ActiveQuery - запрос к базе данных, в нем хранится вся необходимая
        //итнформация о запросе, который нужно выполнить

        $searchModel = new ProductSearch();

        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        $categoriesDropDown = Category::find()->select('title')->indexBy('id')->column();

        return $this->render('index', compact('dataProvider', 'searchModel', 'categoriesDropDown'));
    }



    public function actionCreate()
    {
        $product = new Product();

        if ($product->load(\Yii::$app->request->post()) && $product->save()) {
            \Yii::$app->session->setFlash('success', 'Товар добавлен');
            return $this->redirect(['update', 'id' => $product->id]);
        }

        $categoriesDropDown = Category::find()->select('title')->indexBy('id')->column();

        return $this->render('create', compact('product', 'categoriesDropDown'));
    }



    public function actionUpdate($id)
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundHttpException();
        }

        if ($product->load(\Yii::$app->request->post()) && $product->save()) {
            \Yii::$app->session->setFlash('success', 'Категория обновлена');
            return $this->refresh();
        }

        $categoriesDropDown = Category::find()->select('title')->indexBy('id')->column();

        return $this->render('update', compact('product', 'categoriesDropDown'));
    }



    public function actionDelete($id)
    {
        $category = Product::findOne($id);
        if ($category->delete()) {
            \Yii::$app->session->setFlash('success', 'Товар удален');
            return $this->redirect(['index']);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }




}