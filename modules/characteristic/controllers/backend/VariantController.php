<?php


namespace app\modules\characteristic\controllers\backend;


use app\modules\admin\components\BalletController;
use app\modules\characteristic\forms\VariantForm;
use app\modules\characteristic\models\Characteristic;
use app\modules\characteristic\models\Variant;
use app\modules\characteristic\models\VariantSearch;
use app\modules\characteristic\services\CharacteristicService;
use DomainException;
use RuntimeException;
use Yii;

class VariantController extends BalletController
{
    private $service;

    public function __construct($id, $module, CharacteristicService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex($id)
    {
        $characteristic = Characteristic::getOrFail($id);

        $searchModel = new VariantSearch($characteristic);
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('variant', compact('dataProvider', 'searchModel', 'characteristic'));
    }

    public function actionCreate($id)
    {
        $characteristic = Characteristic::getOrFail($id);
        $createForm = new VariantForm();

        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
           try{
               $this->service->addVariant($characteristic->id, $createForm);
               Yii::$app->session->setFlash('success', 'Вариант добавлен');
               return $this->redirect(['index', 'id' => $characteristic->id]);
           } catch (DomainException $e) {
               Yii::$app->session->setFlash('error', $e->getMessage());
           } catch (RuntimeException $e) {
               Yii::$app->errorHandler->logException($e);
               Yii::$app->session->setFlash('error', 'Техническая ошибка');
           }
        }
        return $this->render('create', compact('createForm', 'characteristic'));
    }

    public function actionUpdate($id)
    {
        $variant = Variant::getOrFail($id);
        $characteristic = Characteristic::getOrFail($variant->characteristic_id);
        $updateForm = new VariantForm($variant);

        if($updateForm->load(\Yii::$app->request->post()) && $updateForm->validate()){
            try {
                $this->service->editVariant($characteristic->id, $variant->id ,$updateForm);
                \Yii::$app->session->setFlash('success', 'Вариант обновлен');
                return $this->redirect(['index', 'id' => $characteristic->id]);
            } catch (\DomainException $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            } catch(\RuntimeException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', 'Техническая ошибка');
            }
        }
        return $this->render('update', compact('characteristic', 'updateForm'));
    }

    public function actionDelete($id)
    {
        $variant = Variant::getOrFail($id);
        $characteristic = Characteristic::getOrFail($variant->characteristic_id);

        try {
            $this->service->deleteVariant($characteristic->id,$variant->id);
            \Yii::$app->session->setFlash('success', 'Вариант удален');
            return $this->redirect(['index', 'id'=>$characteristic->id]);
        } catch (\DomainException $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
        } catch (\RuntimeException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', 'Техническая ошибка');
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

}
