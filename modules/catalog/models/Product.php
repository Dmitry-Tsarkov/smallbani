<?php


namespace app\modules\catalog\models;

use yii\db\ActiveRecord;

/**
 * @property string $id
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property string $description
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $category_id [int(11)]
 */
class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{catalog_products}}';
    }
}