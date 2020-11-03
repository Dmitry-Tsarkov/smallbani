<?php


namespace app\modules\portfolio\controllers;


use app\modules\portfolio\readModels\CategoryReadRepository;
use app\modules\portfolio\readModels\PortfolioReadRepository;
use app\modules\review\readModels\ReviewReadRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class FrontendController extends Controller
{
    private $portfolios;
    private $categories;
    /**
     * @var ReviewReadRepository
     */
    private $reviews;

    public function __construct(
        $id,
        $module,
        PortfolioReadRepository $portfolios,
        CategoryReadRepository $categories,
        ReviewReadRepository $reviews,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->portfolios = $portfolios;
        $this->categories = $categories;
        $this->reviews = $reviews;
    }

    public function actionIndex()
    {
        $dataProvider = $this->portfolios->getList();
        $categories = $this->categories->getCategories();

        return $this->render('index', compact('dataProvider', 'categories'));

    }

    public function actionCategory($alias)
    {
        if (!$currentCategory = $this->categories->findByAlias($alias)) {
            throw new NotFoundHttpException();
        }

        $dataProvider = $this->portfolios->getList($currentCategory->id);
        $categories = $this->categories->getCategories();

        return $this->render('category', compact('dataProvider', 'currentCategory', 'categories'));
    }

    public function actionView($alias)
    {
        if(!$portfolio = $this->portfolios->findByAlias($alias)) {
            throw new NotFoundHttpException();
        }

        $reviews = $this->reviews->forPortfolio($portfolio);

        return $this->render('detailed', compact('portfolio', 'reviews'));
    }

}
