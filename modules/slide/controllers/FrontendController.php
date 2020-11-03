<?php

namespace app\modules\slide\controllers;

use app\modules\slide\models\Slide;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        $slides = Slide::find()->andWhere(['is_active' => true])->orderBy('position')->all();
        return $this->render('index', compact('slides'));
    }

}
