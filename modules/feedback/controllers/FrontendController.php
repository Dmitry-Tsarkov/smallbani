<?php

namespace app\modules\feedback\controllers;

use app\modules\feedback\forms\CallbackForm;
use app\modules\feedback\forms\FeedbackForm;
use app\modules\feedback\forms\PortfolioForm;
use app\modules\feedback\forms\PreviewForm;
use app\modules\feedback\services\FeedbackService;
use DomainException;
use kartik\form\ActiveForm;
use RuntimeException;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class FrontendController extends  Controller
{

    /**
     * @var FeedbackService
     */

    private $feedbackService;

    public function __construct($id, $module, FeedbackService $feedbackService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->feedbackService = $feedbackService;
    }

    public function actionTest()
    {
        return $this->render('test');
    }

    public function actionFeedback()
    {
        $feedbackForm = new FeedbackForm();

        if (Yii::$app->request->isAjax && $feedbackForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($feedbackForm);
        }

        if ($feedbackForm->load(Yii::$app->request->post()) && $feedbackForm->validate()) {
            try {
                $this->feedbackService->feedback($feedbackForm);
                Yii::$app->session->setFlash('feedback_success', true);
                return $this->redirect(['success']);
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        Yii::$app->session->setFlash('feedback_error', true);

        return $this->redirect(['error']);
    }

    public function actionCallback()
    {
        $callbackForm = new CallbackForm();

        if (Yii::$app->request->isAjax && $callbackForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($callbackForm);
        }

        if ($callbackForm->load(Yii::$app->request->post()) && $callbackForm->validate()) {
            try {
                $this->feedbackService->callback($callbackForm);
                Yii::$app->session->setFlash('feedback_success', true);
                return $this->redirect(['success']);
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        Yii::$app->session->setFlash('feedback_error', true);

        return $this->redirect(['error']);
    }

    public function actionPortfolio()
    {
        $portfolioForm = new PortfolioForm();

        if (Yii::$app->request->isAjax && $portfolioForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($portfolioForm);
        }

        if ($portfolioForm->load(Yii::$app->request->post()) && $portfolioForm->validate()) {
            try {
                $this->feedbackService->portfolio($portfolioForm);
                Yii::$app->session->setFlash('feedback_success', true);
                return $this->redirect(['success']);
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        Yii::$app->session->setFlash('feedback_error', true);

        return $this->redirect(['error']);
    }

    public function actionPreview()
    {
        $previewForm = new PreviewForm();

        if (Yii::$app->request->isAjax && $previewForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($previewForm);
        }

        if ($previewForm->load(Yii::$app->request->post()) && $previewForm->validate()) {
            try {
                $this->feedbackService->preview($previewForm);
                Yii::$app->session->setFlash('feedback_success', true);
                return $this->redirect(['success']);
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        Yii::$app->session->setFlash('feedback_error', true);

        return $this->redirect(['error']);
    }

    public function actionPreviewProduct()
    {
        $previewForm = new PreviewForm();

        if (Yii::$app->request->isAjax && $previewForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($previewForm);
        }

        if ($previewForm->load(Yii::$app->request->post()) && $previewForm->validate()) {
            try {
                $this->feedbackService->previewProduct($previewForm);
                Yii::$app->session->setFlash('feedback_success', true);
                return $this->redirect(['success']);
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        Yii::$app->session->setFlash('feedback_error', true);

        return $this->redirect(['error']);
    }

    public function actionPreviewPortfolio()
    {
        $previewForm = new PreviewForm();

        if (Yii::$app->request->isAjax && $previewForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($previewForm);
        }

        if ($previewForm->load(Yii::$app->request->post()) && $previewForm->validate()) {
            try {
                $this->feedbackService->previewPortfolio($previewForm);
                Yii::$app->session->setFlash('feedback_success', true);
                return $this->redirect(['success']);
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
            }
        }

        Yii::$app->session->setFlash('feedback_error', true);

        return $this->redirect(['error']);
    }

    public function actionSuccess()
    {
        if(!Yii::$app->session->getFlash('feedback_success')) {
            return $this->goHome();
        }

        return $this->render('success');
    }

    public function actionError()
    {
        if(!Yii::$app->session->getFlash('feedback_error')) {
            return $this->goHome();
        }

        return $this->render('error');
    }
}
