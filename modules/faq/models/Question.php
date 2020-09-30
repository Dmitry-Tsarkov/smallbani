<?php


namespace app\modules\faq\models;


use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @property int $id [int(11)]
 * @property string $question [varchar(255)]
 * @property string $answer
 * @property int $position [int(11)]
 * @property int $status [int(11)]
 *
 * @mixin PositionBehavior
 */
class Question extends ActiveRecord
{
    public function behaviors()
    {
        return [
            PositionBehavior::class
        ];
    }

    public static function tableName()
    {
        return '{{faq_question}}';
    }

    public function rules()
    {
        return [
            [['question', 'answer'], 'required'],
            [['status'], 'in', 'range' => [0, 1], 'message' => 'Некорректный статус'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'question' => 'Вопрос',
            'answer'   => 'Ответ',
            'status'   => 'Статус',
        ];
    }
}