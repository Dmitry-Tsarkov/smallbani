<?php

namespace app\modules\catalog\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\catalog\forms\ClientPhotosForm;
use app\modules\catalog\forms\ColourGroupForm;
use app\modules\catalog\forms\DrawingsForm;
use app\modules\catalog\forms\PhotosForm;
use app\modules\catalog\forms\ProductCreateForm;
use app\modules\catalog\forms\ProductUpdateForm;
use app\modules\catalog\models\ColourGroup;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductSearch;
use app\modules\catalog\services\ProductService;
use app\modules\colour\models\Colour;
use app\modules\colour\models\ColourSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
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
                    'delete' => ['POST'],
                    'delete-image' => ['POST'],
                    'sort-images' => ['POST'],
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
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (\RuntimeException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

       // var_dump($result); die();

        return $this->render('update', compact('product', 'updateForm'));
    }

    public function actionDelete($id)
    {
        $product = Product::getOrFail($id);

        try {
            $this->service->delete($product->id);
            \Yii::$app->session->setFlash('success', 'Товар удален');
            return $this->redirect(['index']);
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionActivate($id)
    {
        $product = Product::getOrFail($id);

        try {
            $this->service->activate($product->id);
            \Yii::$app->session->setFlash('success', 'Товар активирован');
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionDraft($id)
    {
        $product = Product::getOrFail($id);

        try {
            $this->service->draft($product->id);
            \Yii::$app->session->setFlash('success', 'Товар заблокирован');
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionPopular($id)
    {
        $product = Product::getOrFail($id);

        try {
            $this->service->popular($product->id);
            \Yii::$app->session->setFlash('success', 'Товар сделан популярным');
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionUsual($id)
    {
        $product = Product::getOrFail($id);

        try {
            $this->service->usual($product->id);
            \Yii::$app->session->setFlash('success', 'Товар больше не популярный');
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', 'Техническая ошибка');
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

    public function actionSortImages($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->sortImages($id, \Yii::$app->request->post('oldIndex'),  \Yii::$app->request->post('newIndex'));
            return [];
        } catch (\DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }

    public function actionUploadClientPhoto($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $product = Product::getOrFail($id);
        $photosForm = new ClientPhotosForm();

        if ($photosForm->validate()) {
            try {
                $this->service->addClientPhoto($product->id, $photosForm);
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

    public function actionDeleteClientPhoto($id, $photoId)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->removeClientPhoto($id, $photoId);
            return [];
        } catch (\DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }

    public function actionSortClientPhotos($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->sortClientPhotos($id, \Yii::$app->request->post('oldIndex'),  \Yii::$app->request->post('newIndex'));
            return [];
        } catch (\DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }

    public function actionUploadDrawings($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $product = Product::getOrFail($id);
        $drawingsForm = new DrawingsForm();

        if ($drawingsForm->validate()) {
            try {
                $this->service->addDrawing($product->id, $drawingsForm);
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

    public function actionDeleteDrawing($id, $drawingId)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->removeDrawing($id, $drawingId);
            return [];
        } catch (\DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }

    public function actionSortDrawings($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->sortDrawing($id, \Yii::$app->request->post('oldIndex'),  \Yii::$app->request->post('newIndex'));
            return [];
        } catch (\DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }

    public function actionAddColourGroup($product_id)
    {
        $product = Product::getOrFail($product_id);

        $groupForm = new ColourGroupForm();

        if ($groupForm->load(\Yii::$app->request->post()) && $groupForm->validate()) {
            try {
                $this->service->addColourGroup($product->id, $groupForm);
                \Yii::$app->session->setFlash('success', 'Группа цветов добавлена');
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('colorGroup/add', compact('product', 'groupForm'));
    }

    public function actionUpdateColourGroup($id)
    {
        $group = ColourGroup::getOrFail($id);

        $product = Product::getOrFail($group->product_id);

        $groupForm = new ColourGroupForm($group);

        if ($groupForm->load(\Yii::$app->request->post()) && $groupForm->validate()) {
            try {
                $this->service->updateColourGroup($group->product_id, $group->id, $groupForm);
                \Yii::$app->session->setFlash('success', 'Группа цветов обновлена');
                return $this->redirect(['view', 'id' => $group->product_id]);
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (\RuntimeException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

        return $this->render('colorGroup/update', compact('product', 'group', 'groupForm'));
    }

    public function actionDeleteColourGroup($id)
    {
        $group = ColourGroup::getOrFail($id);
        $product = Product::getOrFail($group->product_id);

        try {
            $this->service->deleteColourGroup($product->id, $group->id);
            \Yii::$app->session->setFlash('success', 'Группа удалена');
            return $this->redirect(['view', 'id' => $product->id]);
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

}
