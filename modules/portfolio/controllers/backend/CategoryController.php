<?php


namespace app\modules\portfolio\controllers\backend;


use app\modules\admin\components\BalletController;
use app\modules\portfolio\models\PortfolioCategory;
use app\modules\portfolio\models\PortfolioCategorySearch;

class CategoryController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new PortfolioCategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $category = new PortfolioCategory();

        if ($category->load(\Yii::$app->request->post()) && $category->save()) {
            \Yii::$app->session->setFlash('success', 'Категория добавлена');
            return $this->redirect(['index']);
        }

        return $this->render('create', compact('category'));
    }

    public function actionUpdate($id)
    {
        $category = PortfolioCategory::getOrFail($id);

        if ($category->load(\Yii::$app->request->post()) && $category->save()) {
            \Yii::$app->session->setFlash('success', 'Категория обновлена');
            return $this->refresh();
        }

        return $this->render('update', compact('category'));
    }

    public function actionDelete($id)
    {
        if (PortfolioCategory::getOrFail($id)->delete()) {
            \Yii::$app->session->setFlash('success', 'Категория удалена');
            return $this->redirect(['index']);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }
}
