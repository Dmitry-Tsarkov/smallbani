<?php

namespace app\modules\slide\models;

use app\modules\admin\behaviors\ImageBehavior;
use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * Class Slide
 * @package app\modules\slide\models
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 * @property int $is_active [int(11)]
 * @property int $position [int(11)]
 * @property string $link_text [varchar(255)]
 * @property string $link_href [varchar(255)]
 * @property int $link_is_blank [int(11)]
 * @property int $active_from [int(11)]
 * @property int $active_to [int(11)]
 *  * @mixin ImageBehavior
 */

class Slide extends ActiveRecord
{

    use QueryExceptions;

    public function behaviors()
    {
        return [
            PositionBehavior::class,
            'image' => [
                'class' => ImageBehavior::class,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                    'preview' => ['width' => 370, 'height' => 370],
                    'view' => ['width' => 1170, 'height' => 400],
                ],
                'folder' => 'slide'
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%slides}}';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['is_active', 'link_is_blank'], 'boolean'],
            ['image', 'image', 'extensions' => 'jpeg, png, jpg'],
            [['link_text', 'link_href'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'         => 'Заголовок',
            'is_active'     => 'Активность',
            'position'      => 'Позиция',
            'link_text'     => 'Текст кнопки',
            'link_href'     => 'Ссылка кнопки',
            'link_is_blank' => 'Переход на другую страницу',
            'active_from'   => 'Активно с',
            'active_to'     => 'Активно до',
        ];
    }
}
