<?php


namespace app\modules\feedback\models;

use app\modules\admin\traits\QueryExceptions;
use app\modules\catalog\models\Product;
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
    use QueryExceptions;

    const TYPE_CALLBACK = 'callback';
    const TYPE_FEEDBACK = 'feedback';
    const TYPE_PORTFOLIO = 'portfolio';
    const TYPE_PREVIEW = 'preview';

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'ФИО',
            'email' => 'E-mail',
            'text' => 'Вопрос',
            'phone' => 'Теленфон',
            'type' => 'Тип',
            'portfolio_title' => 'Название портфолио',
            'created_at' => 'Дата',
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

    public static function preview($name, $phone): self
    {
        $self = new self();
        $self->name = $name;
        $self->phone = $phone;
        $self->phone = $phone;
        $self->type = self::TYPE_PREVIEW;
        $self->status = FeedbackStatus::new();
        return $self;
    }

    public static function previewProduct($name, $phone, Product $product): self
    {
        $self = new self();
        $self->name = $name;
        $self->phone = $phone;
        $self->product_id = $product->id;
        $self->product_title = $product->title;
        $self->type = self::TYPE_PREVIEW;
        $self->status = FeedbackStatus::new();
        return $self;
    }

    public static function previewPortfolio($name, $phone, Portfolio $portfolio): self
    {
        $self = new self();
        $self->name = $name;
        $self->phone = $phone;
        $self->portfolio_id = $portfolio->id;
        $self->portfolio_title = $portfolio->title;
        $self->type = self::TYPE_PREVIEW;
        $self->status = FeedbackStatus::new();
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
