<?php

namespace app\modules\actions\widgets;

use app\modules\actions\readModels\PromoReadRepository;
use yii\base\Widget;

class RelevantActionsWidget extends Widget
{
    private $actions;

    public function __construct(PromoReadRepository $actions, $config = [])
    {
        parent::__construct($config);
        $this->actions = $actions;
    }

    public function run()
    {
        $actions = $this->actions->getRelevant();
        return $this->render('relevant', compact('actions'));
    }

}
