<?php


namespace app\modules\slide\widgets;

use app\modules\slide\models\Slide;
use yii\base\Widget;

class SliderWidget extends Widget
{
    public function run()
    {
        $slides = Slide::find()->all();
        return $this->render('slider', compact('slides'));
    }
}
