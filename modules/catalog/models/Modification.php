<?php


namespace app\modules\catalog\models;

use app\modules\colour\models\Colour;
use yii\db\ActiveRecord;

/**
 * Class Modification
 * @package app\modules\catalog\models
 * @property int $id [int(11)]
 * @property int $group_id [int(11)]
 * @property int $colour_id [int(11)]
 *
 * @property ColourGroup $group
 * @property Colour $colour
 */
class Modification extends ActiveRecord
{
    public static function tableName()
    {
        return 'modifications';
    }

    public function getGroup()
    {
        return $this->hasOne(ColourGroup::class, ['id' => 'group_id']);
    }

    public function getColour()
    {
        return $this->hasOne(Colour::class, ['id' => 'colour_id']);
    }
}
