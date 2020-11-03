<?php


namespace app\modules\colour\models;


use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;


/**
 * Class Colour
 * @package app\modules\colour\models
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property int $hex [int(11)]
 */

class Colour extends ActiveRecord
{
    use QueryExceptions;

    public static function tableName()
    {
        return 'colours';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'hex'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'hex'   => 'Номер цвета (hex)',
        ];
    }

}
