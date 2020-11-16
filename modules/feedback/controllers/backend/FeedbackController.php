<?php


namespace app\modules\feedback\controllers\backend;


use app\modules\admin\components\BalletController;
use app\modules\feedback\models\FeedbackCallbackSearch;
use app\modules\feedback\models\FeedbackPortfolioSearch;
use app\modules\feedback\models\FeedbackSearch;

class FeedbackController extends BalletController
{
    public function actionFeedbackPortfolio()
    {
        $searchModel = new FeedbackPortfolioSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('feedback-portfolio', compact('dataProvider', 'searchModel'));
    }

    public function actionCallbackPortfolio()
    {
        $searchModel = new FeedbackCallbackSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('feedback-callback', compact('dataProvider', 'searchModel'));
    }

    public function actionFeedback()
    {
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('feedback', compact('dataProvider', 'searchModel'));
    }
}
