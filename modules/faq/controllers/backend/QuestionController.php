<?php

namespace app\modules\faq\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\faq\models\Question;
use app\modules\faq\models\QuestionSearch;
use yii\web\NotFoundHttpException;

class QuestionController extends BalletController
{
    public function actionIndex()
    {
        $searchModel  = new QuestionSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }


    public function actionCreate()
    {
        $question = new Question();

        if ($question->load(\Yii::$app->request->post()) && $question->save()) {
            \Yii::$app->session->setFlash('success', 'Вопрос добавлен');
            return $this->redirect(['update', 'id' => $question->id]);
        }

        return $this->render('create', compact('question'));
    }

    public function actionUpdate($id)
    {
        $question = Question::getOrFail($id);

        if ($question->load(\Yii::$app->request->post()) && $question->save()) {
            \Yii::$app->session->setFlash('success', 'Вопрос-ответ обновлен');
            return $this->refresh();
        }

        return $this->render('update', compact('question'));
    }

    public function actionDelete($id)
    {
        $question = Question::getOrFail($id);
        if ($question->delete()) {
            \Yii::$app->session->setFlash('success', 'Вопрос-ответ удален');
            return $this->redirect(['index']);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionMoveUp($id)
    {
        Question::getOrFail($id)->movePrev();
    }

    public function actionMoveDown($id)
    {
        Question::getOrFail($id)->moveNext();
    }

}
