<?php

namespace app\modules\feedback\services;

use app\modules\catalog\repositories\ProductRepository;
use app\modules\characteristic\models\Variant;
use app\modules\feedback\forms\CallbackForm;
use app\modules\feedback\forms\FeedbackForm;
use app\modules\feedback\forms\PortfolioForm;
use app\modules\feedback\forms\PreviewForm;
use app\modules\feedback\models\Feedback;
use app\modules\feedback\repositories\FeedbackRepository;
use app\modules\portfolio\models\Portfolio;
use app\modules\portfolio\repositories\PortfolioRepository;

class FeedbackService
{
    private $mailer;
    private $feedbacks;
    private $portfolios;
    /**
     * @var ProductRepository
     */
    private $products;

    public function __construct(FeedbackMailer $mailer, FeedbackRepository $feedbacks, PortfolioRepository $portfolios, ProductRepository $products)
    {
        $this->mailer = $mailer;
        $this->feedbacks = $feedbacks;
        $this->portfolios = $portfolios;
        $this->products = $products;
    }

    public function callback(CallbackForm $form)
    {
        $callback = Feedback::callback(
            $form->name,
            $form->phone
        );

        $this->feedbacks->save($callback);
        $this->mailer->callback($callback);
    }

    public function feedback(FeedbackForm $form)
    {
        $feedback = Feedback::feedback(
            $form->name,
            $form->email,
            $form->text
        );

        $this->feedbacks->save($feedback);
        $this->mailer->feedback($feedback);
    }

    public function portfolio(PortfolioForm $form)
    {
        $portfolio = $this->portfolios->getById($form->portfolioId);

        $portfolioFeedback = Feedback::affordTheSamePortfolio(
            $form->name,
            $form->phone,
            $portfolio
        );
        $this->feedbacks->save($portfolioFeedback);
        $this->mailer->portfolio($portfolioFeedback);
    }

    public function preview(PreviewForm $form)
    {
        $feedback = Feedback::preview(
            $form->name,
            $form->phone
        );

        $this->feedbacks->save($feedback);
        $this->mailer->preview($feedback);
    }

    public function previewPortfolio(PreviewForm $form)
    {
        $feedback = Feedback::previewPortfolio(
            $form->name,
            $form->phone,
            $this->portfolios->getById($form->portfolioId)
        );

        $this->feedbacks->save($feedback);
        $this->mailer->preview($feedback);
    }

    public function previewProduct(PreviewForm $form)
    {
        $feedback = Feedback::previewProduct(
            $form->name,
            $form->phone,
            $this->products->getById($form->productId)
        );

        $this->feedbacks->save($feedback);
        $this->mailer->preview($feedback);
    }
}
