<?php

namespace app\modules\feedback\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\feedback\forms\massive\FeedbackMassiveDeleteForm;
use app\modules\feedback\forms\massive\FeedbackMassiveStatusForm;
use app\modules\feedback\models\Feedback;
use Yii;

class MassiveController extends BalletController
{
    public function actionStatus()
    {
        $form = new FeedbackMassiveStatusForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            Feedback::updateAll(['status' => $form->statusId], ['id' => $form->ids]);
        }
    }

    public function actionDelete()
    {
        $form = new FeedbackMassiveDeleteForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            Feedback::deleteAll(['id' => $form->ids]);
        }
    }
}