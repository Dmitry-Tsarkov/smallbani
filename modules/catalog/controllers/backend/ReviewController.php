<?php


namespace app\modules\catalog\controllers\backend;


use app\modules\admin\components\BalletController;
use app\modules\catalog\models\Product;
use app\modules\review\forms\ReviewForm;
use app\modules\review\models\Review;
use app\modules\review\models\ReviewSearch;
use app\modules\review\services\ReviewService;
use DomainException;
use RuntimeException;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Response;

class ReviewController extends BalletController
{

    private $service;

    public function __construct($id, $module, ReviewService $service, $config = [])
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
                ],
            ]
        ];
    }

    public function actionIndex($id)
    {
        $product = Product::getOrFail($id);
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
        $dataProvider->query->andWhere(['product_id' => $product->id]);

        return $this->render('index', compact('dataProvider', 'searchModel', 'product'));
    }

    public function actionCreate($productId)
    {
        $product = Product::getOrFail($productId);

        $createForm = new ReviewForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $review = $this->service->createForProduct($productId, $createForm);
                Yii::$app->session->setFlash('success', 'Отзыв добавлен');
                return $this->redirect(['index', 'id' => $product->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }
        return $this->render('create', compact('createForm', 'product'));
    }

    public function actionUpdate($productId, $reviewId)
    {
        $product = Product::getOrFail($productId);
        $review = Review::getOrFail(['product_id' => $product->id, 'id' => $reviewId]);
        $editForm = new ReviewForm($review);

        if ($editForm->load(Yii::$app->request->post()) && $editForm->validate()) {
            try {
                $this->service->edit($review->id, $editForm);
                Yii::$app->session->setFlash('success', 'Отзыв обновлен');
                return $this->refresh();
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

        return $this->render('update', compact('review', 'editForm', 'product'));

    }

    public function actionDelete($productId, $reviewId)
    {
        $product = Product::getOrFail($productId);

        $review = Review::getOrFail(['product_id' => $product->id, 'id' => $reviewId]);

        try{
            $this->service->delete($review->id);
            \Yii::$app->session->setFlash('success', 'Отзыв удален');
            return $this->redirect(['index', 'id' => $product->id]);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            \Yii::$app->errorHandler->logException($e);
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionDeleteImage($reviewId)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $this->service->deleteImage($reviewId);
            return [];
        } catch (\DomainException $e) {
            return ['error' => $e->getMessage()];
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            return ['error' => 'Техническая ошибка'];
        }
    }

}
