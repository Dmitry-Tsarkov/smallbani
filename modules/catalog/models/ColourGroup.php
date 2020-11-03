<?php


namespace app\modules\catalog\models;


use app\modules\admin\traits\QueryExceptions;
use app\modules\colour\models\Colour;
use yii\db\ActiveRecord;
use yii2tech\ar\linkmany\LinkManyBehavior;
use yii2tech\ar\position\PositionBehavior;

/**
 * Class ColourGroup
 * @package app\modules\colour\models
 * @property int $id [int(11)]
 * @property int $product_id [int(11)]
 * @property string $title [varchar(255)]
 * @property int $position [int(11)]
 *
 * @property Colour[] $colours
 * @property Modification[] $modifications
 *
 * @property array $colourIds
 *
 * @mixin PositionBehavior
 */
class ColourGroup extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            [
                'class' => PositionBehavior::class,
                'groupAttributes' => ['product_id']
            ],
            [
                'class' => LinkManyBehavior::class,
                'relation' => 'colours',
                'relationReferenceAttribute' => 'colourIds',
            ],
        ];
    }

    public static function create($title, array $colourIds = []): self
    {
        if (empty($colourIds)) {
            throw new \DomainException('Укажите цвета');
        }
        $self = new self();
        $self->title = $title;
        $self->colourIds = $colourIds;
        return $self;
    }

    public function edit($title, array $colourIds = [])
    {
        if (empty($colourIds)) {
            throw new \DomainException('Укажите цвета');
        }
        $this->title = $title;
        $this->colourIds = $colourIds;
        $this->markAttributeDirty('title');
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название группы',
            'type'  => 'Позиция'
        ];
    }

    public static function tableName()
    {
        return 'colour_groups';
    }

    public function getColours()
    {
        return $this->hasMany(Colour::class, ['id' => 'colour_id'])
            ->via('modifications');
    }

    public function getModifications()
    {
        return $this->hasMany(Modification::class, ['group_id' => 'id']);
    }
}
