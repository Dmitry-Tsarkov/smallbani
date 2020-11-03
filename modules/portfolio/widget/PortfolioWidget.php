<?php

namespace app\modules\portfolio\widget;

use yii\base\Widget;

class PortfolioWidget extends Widget
{
    public $portfolio;

    public function run()
    {
        return $this->render('portfolio', ['portfolio' => $this->portfolio]);
    }
}
