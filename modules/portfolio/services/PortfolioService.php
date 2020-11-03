<?php

namespace app\modules\portfolio\services;

use app\modules\portfolio\forms\PhotosForm;
use app\modules\portfolio\forms\PortfolioCreateForm;
use app\modules\portfolio\forms\PortfolioUpdateForm;
use app\modules\portfolio\models\Portfolio;
use app\modules\portfolio\models\PortfolioImage;
use app\modules\portfolio\repositories\PortfolioCategoryRepository;
use app\modules\portfolio\repositories\PortfolioRepository;
use app\modules\seo\valueObjects\Seo;

class PortfolioService
{
    private $portfolios;
    private $categories;

    public function __construct(PortfolioRepository $portfolios, PortfolioCategoryRepository $categories)
    {
        $this->portfolios = $portfolios;
        $this->categories = $categories;
    }

    public function create(PortfolioCreateForm $form): Portfolio
    {
        $category = $this->categories->getById($form->categoryId);

        $portfolio = Portfolio::create(
            $form->title,
            $form->alias,
            $form->description,
            $category->id,
            $form->youtube_url,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        foreach ($form->photos->files as $file) {
            $portfolio->addImage(PortfolioImage::create($file));
        }

        $this->portfolios->save($portfolio);
        return $portfolio;
    }

    public function update($id, PortfolioUpdateForm $form): void
    {
        $portfolio = $this->portfolios->getById($id);
        $category = $this->categories->getById($form->categoryId);

        $portfolio->edit(
            $form->title,
            $form->alias,
            $form->description,
            $category->id,
            $form->youtube_url,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        $this->portfolios->save($portfolio);
    }

    public function delete($id)
    {
        $portfolio = $this->portfolios->getById($id);

        if ($portfolio->status == 1) {
            throw new \DomainException('Нельзя удалить активное портфолио');
        }

        $this->portfolios->delete($portfolio);
    }

    public function activate($id)
    {
        $portfolio = $this->portfolios->getById($id);
        $portfolio->activate();
        $this->portfolios->save($portfolio);
    }

    public function draft($id)
    {
        $portfolio = $this->portfolios->getById($id);
        $portfolio->draft();
        $this->portfolios->save($portfolio);
    }

    public function sortImages($id, $oldIndex, $newIndex)
    {
        $portfolio = $this->portfolios->getById($id);
        $portfolio->sortImages($oldIndex, $newIndex);
        $this->portfolios->save($portfolio);
    }

    public function deleteImage($id, $photoId)
    {
        $portfolio = $this->portfolios->getById($id);
        $portfolio->deleteImage($photoId);
        $this->portfolios->save($portfolio);
    }

    public function addImage($id, PhotosForm $form)
    {
        $product = $this->portfolios->getById($id);

        foreach ($form->files as $file) {
            $product->addImage(PortfolioImage::create($file));
        }

        $this->portfolios->save($product);
    }
}
