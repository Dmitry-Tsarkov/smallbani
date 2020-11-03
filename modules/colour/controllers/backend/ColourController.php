<?php


namespace app\modules\colour\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\colour\models\Colour;
use app\modules\colour\models\ColourSearch;

class ColourController extends BalletController
{

    public function actionIndex()
    {
        $searchModel = new ColourSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $colour = new Colour();

        if ($colour->load(\Yii::$app->request->post()) && $colour->save()) {
            \Yii::$app->session->setFlash('success', 'Цвет добавлен');
            return $this->redirect(['update', 'id' => $colour->id]);
        }

        return $this->render('create', compact('colour'));
    }

    public function actionUpdate($id)
    {
        $colour = Colour::getOrFail($id);

        if ($colour->load(\Yii::$app->request->post()) && $colour->save()) {
            \Yii::$app->session->setFlash('success', 'Цвет обновлен');
            return $this->refresh();
        }

        return $this->render('update', compact('colour'));
    }

    public function actionDelete($id)
    {
        $action = Colour::getOrFail($id);
        if ($action->delete()) {
            \Yii::$app->session->setFlash('success', 'Цвет удален');
            return $this->redirect(['index']);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }


}
