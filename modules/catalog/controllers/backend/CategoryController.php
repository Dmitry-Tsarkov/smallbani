<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\CategorySearch;
use Yii;

class CategoryController extends BalletController
{
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionUpdate($id)
    {
        $category = Category::getOrFail($id);

        if ($category->load(\Yii::$app->request->post()) && $category->validate()) {
            $currentParent = $category->parents(1)->one();

            if ($category->parent_id != $currentParent->id) {
                $parent = Category::getOrFail($category->parent_id);
                $category->appendTo($parent);
            } else {
                $category->save();
            }

            \Yii::$app->session->setFlash('success', 'Категория обновлена');
            return $this->refresh();
        }

        return $this->render('update', compact('category'));
    }

    public function actionCreate()
    {
        $category = new Category();

        if ($category->load(\Yii::$app->request->post()) && $category->validate()) {

            $parent = Category::getOrFail($category->parent_id);
            $category->appendTo($parent);

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
        $category = Category::getOrFail($id);
        if($prev = $category->prev()->one()) {
            $category->insertBefore($prev);
        }
    }

    public function actionMoveDown($id)
    {
        $category = Category::getOrFail($id);
        if($next = $category->next()->one()) {
            $category->insertAfter($next);
        }
    }

    public function actionSeo($id)
    {
        $category = Category::getOrFail($id);

        if ($category->load(Yii::$app->request->post()) && $category->save()) {
            \Yii::$app->session->setFlash('success', 'SEO обновлена');
            return $this->refresh();
        }

        return $this->render('seo', compact('category'));
    }
}
