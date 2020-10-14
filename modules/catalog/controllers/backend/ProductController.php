<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\catalog\forms\PhotosForm;
use app\modules\catalog\forms\ProductCreateForm;
use app\modules\catalog\forms\ProductUpdateForm;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductSearch;
use app\modules\catalog\services\ProductService;
use yii\filters\VerbFilter;
use yii\web\Response;

class ProductController extends BalletController
{
    private $service;

    public function __construct($id, $module, ProductService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete-image' => ['POST'],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionView($id)
    {
        $product = Product::getOrFail($id);
        return $this->render('view', compact('product'));
    }

    public function actionCreate()
    {
        $createForm = new ProductCreateForm();


        if ($createForm->load(\Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $product = $this->service->create($createForm);
                \Yii::$app->session->setFlash('success', 'Товар добавлен');
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', compact('createForm', 'photosForm'));
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

    public function actionUpload($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $product = Product::getOrFail($id);
        $photosForm = new PhotosForm();

        if ($photosForm->validate()) {
            try {
                $this->service->addImage($product->id, $photosForm);
                return [];
            } catch (\DomainException $e) {
                return ['error' => $e->getMessage()];
            } catch (\RuntimeException $e) {
                \Yii::$app->errorHandler->logException($e);
                return ['error' => 'Техническая ошибка'];
            }
        }

        return ['error' => 'Не удалось'];
    }

    public function actionDeleteImage($id, $photoId)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->deleteImage($id, $photoId);
            return [];
        } catch (\DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }

}
