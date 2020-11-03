<?php


namespace app\modules\review\controllers\backend;


use app\modules\admin\components\BalletController;
use app\modules\review\forms\ReviewForm;
use app\modules\review\models\Review;
use app\modules\review\models\ReviewSearch;
use app\modules\review\services\ReviewService;
use DomainException;
use RuntimeException;
use Yii;
use yii\filters\VerbFilter;

class ReviewController extends BalletController
{
    private $service;

    public function __construct($id, $module, ReviewService $service, $config = [])
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
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $createForm = new ReviewForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $review = $this->service->create($createForm);
                Yii::$app->session->setFlash('success', 'Отзыв добавлен');
                return $this->redirect(['update', 'id' => $review->id]);
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

        return $this->render('create', compact('createForm'));
    }

    public function actionUpdate($id)
    {
        $review = Review::getOrFail($id);
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

        return $this->render('update', compact('review', 'editForm'));
    }

    public function actionDelete($id)
    {
        try {
            $this->service->delete($id);
            Yii::$app->session->setFlash('success', 'Отзыв удален');
            return $this->redirect(['index']);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (RuntimeException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteImage($id)
    {
        $this->service->deleteImage($id);
        return $this->redirect(Yii::$app->request->referrer);
    }
}
