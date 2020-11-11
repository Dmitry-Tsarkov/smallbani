<?php

namespace app\modules\characteristic\controllers\backend;

use app\modules\admin\components\BalletController;
use app\modules\characteristic\forms\CharacteristicCreateForm;
use app\modules\characteristic\forms\CharacteristicEditForm;
use app\modules\characteristic\forms\VariantForm;
use app\modules\characteristic\models\Characteristic;
use app\modules\characteristic\models\CharacteristicSearch;
use app\modules\characteristic\models\Variant;
use app\modules\characteristic\models\VariantSearch;
use app\modules\characteristic\services\CharacteristicService;
use DomainException;
use RuntimeException;
use Yii;

class CharacteristicController extends BalletController
{
    private $service;

    public function __construct($id, $module, CharacteristicService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $searchModel = new CharacteristicSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        $createForm = new CharacteristicCreateForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            try {
                $characteristic = $this->service->create($createForm);
                Yii::$app->session->setFlash('success', 'Харктеристика добавлена');
                return $this->redirect(['update', 'id' => $characteristic->id]);
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
        $characteristic = Characteristic::getOrFail($id);
        $editForm = new CharacteristicEditForm($characteristic);

        if($editForm->load(\Yii::$app->request->post()) && $editForm->validate()){

            try {
                $this->service->edit($characteristic->id, $editForm);
                \Yii::$app->session->setFlash('success', 'Характеристика обновлена');
                return $this->refresh();
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            } catch(\RuntimeException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }

        return $this->render('update', compact('characteristic', 'editForm'));
    }

    public function actionDelete($id)
    {
        $characteristic = Characteristic::getOrFail($id);

        try {
            $this->service->delete($characteristic->id);
            \Yii::$app->session->setFlash('success', 'Характеристика удалена');
            return $this->redirect(['index']);
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

//    public function actionVariant($id)
//    {
//        $characteristic = Characteristic::getOrFail($id);
//
//        $searchModel = new VariantSearch($characteristic);
//        $dataProvider = $searchModel->search(\Yii::$app->request->get());
//
//        return $this->render('variant', compact('dataProvider', 'searchModel', 'characteristic'));
//    }

}
