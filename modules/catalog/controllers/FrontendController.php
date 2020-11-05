<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\models\Category;
use app\modules\catalog\models\ColourGroup;
use app\modules\catalog\models\Product;
use app\modules\catalog\readModels\CategoryReadRepository;
use app\modules\catalog\readModels\ProductReadRepository;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class FrontendController extends Controller
{
    private $products;
    private $categories;

    public function __construct($id, $module, ProductReadRepository $products, CategoryReadRepository $categories, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->categories = $categories;
    }

    public function actionIndex()
    {
        $categories = $this->categories->getList();
        return $this->render('index', compact('categories'));
    }

    public function actionCategory($alias)
    {
        if(!$category = $this->categories->findByAlias($alias)) {
            throw new NotFoundHttpException();
        }
        $dataProvider = $this->products->inCategory($category);
        $parent = $category->depth == 1 ? $category : $category->parents(1)->one();
        $categories = $this->categories->getTabs($parent);

        return $this->render('category', compact('category', 'dataProvider', 'categories', 'parent'));
    }

    public function actionProduct($alias)
    {
        if(!$product = $this->products->findByAlias($alias)) {
            throw new NotFoundHttpException();
        }

        return $this->render('product', compact('product'));
    }

}
