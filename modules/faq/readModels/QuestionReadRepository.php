<?php


namespace app\modules\faq\readModels;


use app\modules\faq\models\Question;

class QuestionReadRepository
{
    /**
     * @return Question[]
     *
     */
    public function getActive(): array
    {
        return Question::find()
            ->andWhere(['status'=> 1])
            ->orderBy(['position' => SORT_ASC])
            ->all();
    }

}
