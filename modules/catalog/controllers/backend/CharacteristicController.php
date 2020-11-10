<?php


namespace app\modules\catalog\controllers\backend;


use app\modules\admin\components\BalletController;
use app\modules\characteristic\services\CharacteristicService;

class CharacteristicController extends BalletController
{
    public $service;

    public function __construct($id, $module, CharacteristicService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($id)
    {

    }
}
