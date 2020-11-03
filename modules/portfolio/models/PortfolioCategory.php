<?php


namespace app\modules\portfolio\models;

use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Class Portfolio
 * @package app\modules\portfolio\models
 *
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 */

class PortfolioCategory extends ActiveRecord
{
    use QueryExceptions;

    public static function tableName()
    {
        return '{{portfolio_category}}';
    }

    public function behaviors()
    {
        return [
            SlugBehavior::class,
        ];
    }
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'alias'], 'string'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'       => 'Заголовок',
            'alias'       => 'Алиас',
        ];
    }

    public function getPortfolios()
    {
        return $this->hasMany(Portfolio::className(), ['category_id' => 'id']);
    }

    public function getHref()
    {
        return Url::to(['/portfolio/frontend/category', 'alias' => $this->alias]);
    }
}
