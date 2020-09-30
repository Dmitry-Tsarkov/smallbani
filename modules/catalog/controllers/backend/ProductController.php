<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\catalog\forms\ProductCreateForm;
use app\modules\catalog\forms\ProductUpdateForm;
use app\modules\catalog\models\Category;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductSearch;
use app\modules\catalog\services\ProductService;

class ProductController extends BalletController
{
    private $service;

    public function __construct($id, $module, ProductService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
        $categoriesDropDown = Category::find()->select('title')->indexBy('id')->column();

        return $this->render('index', compact('dataProvider', 'searchModel', 'categoriesDropDown'));
    }

    public function actionCreate()
    {
        $createForm = new ProductCreateForm();

        if ($createForm->load(\Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $product = $this->service->create($createForm);
                \Yii::$app->session->setFlash('success', 'Товар добавлен');
                return $this->redirect(['update', 'id' => $product->id]);
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', compact('createForm'));
    }

    public function actionUpdate($id)
    {
        $product = Product::getOrFail($id);
        $updateForm = new ProductUpdateForm($product);

        if ($updateForm->load(\Yii::$app->request->post()) && $updateForm->validate()) {
            try {
                $this->service->update($product->id, $updateForm);
                \Yii::$app->session->setFlash('success', 'Товар обновлен');
                return $this->refresh();
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (\RuntimeException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

        return $this->render('update', compact('product', 'updateForm'));
    }

    public function actionDelete($id)
    {
        if (Product::getOrFail($id)->delete()) {
            \Yii::$app->session->setFlash('success', 'Товар удален');
            return $this->redirect(['index']);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }
}