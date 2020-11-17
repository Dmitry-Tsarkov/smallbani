<?php


namespace app\modules\feedback\widgets;


use yii\base\Widget;

class FeedbackWidget extends Widget
{
    public function run()
    {
        return $this->render('feedback');
    }
}
