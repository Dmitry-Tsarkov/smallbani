<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\CategorySearch;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class CategoryController extends BalletController
{
    public function actionIndex()
    {
        //метод find() вернет объект класса ActiveQuery,
        //ActiveQuery - запрос к базе данных, в нем хранится вся необходимая
        //итнформация о запросе, который нужно выполнить

        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionUpdate($id)
    {
        $category = Category::getOrFail($id);

        if ($category->load(\Yii::$app->request->post()) && $category->save()) {
            \Yii::$app->session->setFlash('success', 'Категория обновлена');
            return $this->refresh();
        }

        return $this->render('update', compact('category'));
    }

    public function actionCreate()
    {
        $category = new Category();

        if ($category->load(\Yii::$app->request->post()) && $category->save()) {
            \Yii::$app->session->setFlash('success', 'Категория добавлена');
            return $this->redirect(['update', 'id' => $category->id]);
        }

        return $this->render('create', compact('category'));
    }

    public function actionDelete($id)
    {
        if (Category::getOrFail($id)->delete()) {
            \Yii::$app->session->setFlash('success', 'Категория удалена');
            return $this->redirect(['index']);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionDeleteImage($id)
    {
        Category::getOrFail($id)->deleteImage();

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionMoveUp($id)
    {
        Category::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Category::getOrFail($id)->moveNext();
    }
}