<?php


namespace app\modules\review\services;


use app\modules\catalog\repositories\ProductRepository;
use app\modules\portfolio\repositories\PortfolioRepository;
use app\modules\review\forms\ReviewForm;
use app\modules\review\models\Review;
use app\modules\review\repositories\ReviewRepository;

class ReviewService
{
    private $reviews;
    private $products;
    private $portfolios;

    public function __construct(
        ReviewRepository $reviews,
        ProductRepository $products,
        PortfolioRepository $portfolios
    )
    {
        $this->reviews = $reviews;
        $this->products = $products;
        $this->portfolios = $portfolios;
    }

    public function create(ReviewForm $form): Review
    {
        $review = Review::create(
            $form->name,
            $form->place,
            $form->review,
            $form->status
        );

        if ($form->image) {
            $review->changePhoto($form->image);
        }

        $this->reviews->save($review);
        return $review;
    }

    public function createForProduct($productId, ReviewForm $form):Review
    {
        $product = $this->products->getById($productId);

        $review = Review::createForProduct(
            $product->id,
            $form->name,
            $form->place,
            $form->review,
            $form->status
        );

        if ($form->image) {
            $review->changePhoto($form->image);
        }

        $this->reviews->save($review);

        return $review;
    }

    public function createForPortfolio($portfolioId, ReviewForm $form): Review
    {
        $portfolio = $this->portfolios->getById($portfolioId);

        $review = Review::createForPortfolio(
            $portfolio->id,
            $form->name,
            $form->place,
            $form->review,
            $form->status
        );

        if ($form->image) {
            $review->changePhoto($form->image);
        }

        $this->reviews->save($review);
        return $review;
    }

    public function edit($id, ReviewForm $form)
    {
        $review = $this->reviews->getById($id);

        $review->edit(
            $form->name,
            $form->place,
            $form->review,
            $form->status
        );

        if ($form->image) {
            $review->changePhoto($form->image);
        }

        $this->reviews->save($review);
    }

    public function delete($id)
    {
        $review = $this->reviews->getById($id);

        if ($review->status == 1) {
            throw new \DomainException('Нельзя удалить активный отзыв');
        }

        $this->reviews->delete($review);
    }

    public function deleteImage($id)
    {
        $review = $this->reviews->getById($id);
        $review->deleteImage();
    }
}
