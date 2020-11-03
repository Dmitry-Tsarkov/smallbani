<?php


namespace app\modules\review\controllers;


use app\modules\review\models\Review;
use app\modules\review\readModels\ReviewReadRepository;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class FrontendController extends Controller
{

    private $reviews;

    public function __construct($id, $module, ReviewReadRepository $reviews, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->reviews = $reviews;
    }

    public function actionIndex()
    {
        $dataProvider = $this->reviews->getList();
        return $this->render('index', compact('dataProvider'));
    }
}
