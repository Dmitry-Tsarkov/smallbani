<?php


namespace app\modules\faq\readModels;

use app\modules\faq\models\Question;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $questions = Question::find()->all();
        return $this->render('index', compact('questions'));
    }
}
