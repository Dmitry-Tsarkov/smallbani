<?php


namespace app\modules\review\forms;


use app\modules\review\models\Review;
use yii\base\Model;
use yii\web\UploadedFile;

class ReviewForm extends Model
{
    public $status;
    public $name;
    public $place;
    public $review;
    public $image;

    public function __construct(Review $review = null)
    {
        if ($review) {
            $this->status = $review->status;
            $this->name = $review->name;
            $this->place = $review->place;
            $this->review = $review->review;
        }
        parent::__construct();
    }

    public function rules()
    {
        return [
            [['name', 'review', 'place'], 'required'],
            [['name', 'review','place'], 'string'],
            [['status'], 'integer'],
            [['status'], 'in', 'range' => [0, 1], 'message' => 'Некорректный статус'],
            ['image', 'image', 'extensions' => 'jpeg, png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'   => 'ФИО',
            'place'  => 'Место',
            'review' => 'Отзыв',
            'image'  => 'Аватар',
            'status' => 'Статус',
            'productId' => 'Id товара',
        ];
    }

    public function beforeValidate()
    {
        $this->image = UploadedFile::getInstance($this, 'image');
        return parent::beforeValidate();
    }
}
