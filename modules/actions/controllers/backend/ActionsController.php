<?php


namespace app\modules\actions\controllers\backend;

use app\modules\actions\models\Promo;
use app\modules\actions\models\PromoSearch;
use app\modules\admin\components\BalletController;
use Yii;

class ActionsController extends BalletController
{

    public function actionIndex()
    {
        $searchModel = new PromoSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $action = new Promo();

        if ($action->load(\Yii::$app->request->post()) && $action->save()) {
            \Yii::$app->session->setFlash('success', 'Акция добавлена');
            return $this->redirect(['update', 'id' => $action->id]);
        }

        return $this->render('create', compact('action'));
    }

    public function actionUpdate($id)
    {
        $action = Promo::getOrFail($id);

        if ($action->load(\Yii::$app->request->post()) && $action->save()) {
            \Yii::$app->session->setFlash('success', 'Акция обновлена');
            return $this->refresh();
        }

        return $this->render('update', compact('action', 'actions'));
    }

    public function actionDelete($id)
    {
        $action = Promo::getOrFail($id);
        if ($action->delete()) {
            \Yii::$app->session->setFlash('success', 'Акция удалена');
            return $this->redirect(['index']);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionDeleteImage($id)
    {
        Promo::getOrFail($id)->deleteImage();

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionSeo($id)
    {
        $action = Promo::getOrFail($id);

        if ($action->load(Yii::$app->request->post()) && $action->save()) {
            \Yii::$app->session->setFlash('success', 'SEO обновлена');
            return $this->refresh();
        }

        return $this->render('seo', compact('action'));
    }
}
