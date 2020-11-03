<?php


namespace app\modules\portfolio\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\portfolio\forms\PhotosForm;
use app\modules\portfolio\forms\PortfolioCreateForm;
use app\modules\portfolio\models\Portfolio;
use app\modules\portfolio\models\PortfolioSearch;
use app\modules\portfolio\forms\PortfolioUpdateForm;
use app\modules\portfolio\services\PortfolioService;
use yii\filters\VerbFilter;
use yii\web\Response;

class PortfolioController extends BalletController
{
    private $service;

    public function __construct($id, $module, PortfolioService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
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
        $searchModel = new PortfolioSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionUpdate($id)
    {
        $portfolio = Portfolio::getOrFail($id);
        $updateForm = new PortfolioUpdateForm($portfolio);

        if ($updateForm->load(\Yii::$app->request->post()) && $updateForm->validate()) {
            try {
                $this->service->update($portfolio->id, $updateForm);
                \Yii::$app->session->setFlash('success', 'Товар обновлен');
                return $this->refresh();
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (\RuntimeException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

        return $this->render('update', compact('portfolio', 'updateForm'));
    }

    public function actionCreate()
    {
        $createForm = new PortfolioCreateForm();

        if ($createForm->load(\Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $product = $this->service->create($createForm);
                \Yii::$app->session->setFlash('success', 'Портфолио добавлено');
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', compact('createForm', 'photosForm'));
    }

    public function actionView($id)
    {
        $portfolio = Portfolio::getOrFail($id);
        return $this->render('view', compact('portfolio'));
    }

    public function actionActivate($id)
    {
        $portfolio = Portfolio::getOrFail($id);

        try {
            $this->service->activate($portfolio->id);
            \Yii::$app->session->setFlash('success', 'Портфолио активировано');
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
        $product = Portfolio::getOrFail($id);

        try {
            $this->service->draft($product->id);
            \Yii::$app->session->setFlash('success', 'Портфолио заблокировано');
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(\Yii::$app->request->referrer);
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

    public function actionDelete($id)
    {
        $product = Portfolio::getOrFail($id);

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

    public function actionUpload($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $product = Portfolio::getOrFail($id);
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
}
