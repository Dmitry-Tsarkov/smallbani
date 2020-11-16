<?php


namespace app\modules\feedback\models;

use app\modules\portfolio\models\Portfolio;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property int $portfolio_id [int(11)]
 * @property string $name [varchar(255)]
 * @property string $email [varchar(255)]
 * @property string $text [varchar(255)]
 * @property string $phone [varchar(255)]
 * @property int $type [int(11)]
 * @property int $portfolio_title [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 *
 * @property FeedbackStatus $status
 */

class Feedback extends ActiveRecord
{
    const TYPE_CALLBACK = 'callback';
    const TYPE_FEEDBACK = 'feedback';
    const TYPE_PORTFOLIO = 'portfolio';

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function tableName()
    {
        return '{{feedbacks}}';
    }

    public static function callback($name, $phone): self
    {
        $self = new self();
        $self->name = $name;
        $self->phone = $phone;
        $self->type = self::TYPE_CALLBACK;
        $self->status = FeedbackStatus::new();
        return $self;
    }

    public static function feedback($name, $email, $text): self
    {
        $self = new self();
        $self->name = $name;
        $self->email = $email;
        $self->text = $text;
        $self->type = self::TYPE_FEEDBACK;
        $self->status = FeedbackStatus::new();
        return $self;
    }

    public static function affordTheSamePortfolio($name, $phone, Portfolio $portfolio): self
    {
        $self = new self();
        $self->name = $name;
        $self->phone = $phone;
        $self->type = self::TYPE_PORTFOLIO;
        $self->status = FeedbackStatus::new();
        $self->portfolio_id = $portfolio->id;
        $self->portfolio_title = $portfolio->title;
        return $self;
    }

    public function changeStatus(FeedbackStatus $status)
    {
        $this->status = $status;
    }

    public function isNew()
    {
        return $this->status->isNew();
    }

    public function beforeSave($insert)
    {
        $this->setAttribute('status', $this->status->getValue());
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->status = new FeedbackStatus($this->getAttribute('status'));
        parent::afterFind();
    }

}
