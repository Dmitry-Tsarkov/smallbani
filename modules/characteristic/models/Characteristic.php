<?php


namespace app\modules\characteristic\models;


use app\modules\admin\traits\QueryExceptions;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $unit [varchar(255)]
 * @property string $type [varchar(255)]
 *
 * @property Variant[] $variants
 */

class Characteristic extends ActiveRecord
{
    const TYPE_TEXT = 0;
    const TYPE_DROP_DOWN = 1;

    use QueryExceptions;

    public static function tableName()
    {
        return '{{characteristics}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    'variants'
                ],
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'unit'  => 'Ед. измерения',
            'type'  => 'Как будет вводиться информация',
        ];
    }

    public static function create($title, $unit, $type): Characteristic
    {
        $characteristic = new Characteristic();
        $characteristic->title = $title;
        $characteristic->unit = $unit;
        $characteristic->type = $type;

        return $characteristic;
    }

    public function edit($title, $unit): void
    {
        $this->title = $title;
        $this->unit = $unit;
    }

    public function isDropDown(): bool
    {
        return $this->type == Characteristic::TYPE_DROP_DOWN;
    }

    public function createValue($text, $isMain = true): Value
    {
        if ($this->isDropDown()) {
            if(!$variant = $this->findVariantByValue($text)) {
                $variant = Variant::create($this->id, $text);
                $variant->save();
            }
            return Value::createVariant($this->id, $variant->id, $isMain);
        } else {
            return Value::createValue($this->id, $text, $isMain);
        }
    }

    public function findVariantByValue(string $valueText): ?Variant
    {
        foreach ($this->variants as $variant) {
            if ($variant->value == $valueText) {
                return $variant;
            }
        }

        return null;
    }

    public function getVariants()
    {
        return $this->hasMany(Variant::class, ['characteristic_id' => 'id']);
    }

    public function addVariant(Variant $variant): void
    {
        $variants = $this->variants;
        foreach ($variants as $current) {
            if ($current->value == $variant->value) {
                throw new \DomainException("Такое значение уже есть");
            }
        }
        $variants[] = $variant;
        $this->variants = $variants;
    }

    public function editVariant($id, $value)
    {
        $variants = $this->variants;
        foreach ($variants as $i => $variant) {
            if ($variant->id == $id) {
                $variant->edit($value);

                foreach ($variants as $current) {
                    if ($variant !== $current && $current->value == $value) {
                        throw new \DomainException('Такое значение уже есть');
                    }
                }

                $this->variants = $variants;
                return;
            }
        }
        throw new \DomainException("Вариант не нейден");
    }

    public function removeVariant($id)
    {
        $variants = $this->variants;
        foreach ($variants as $i => $current) {
            if ($current->id == $id) {
                unset($variants[$i]);
                $this->variants = $variants;
                return;
            }
        }
        throw new \DomainException("Вариант не нейден");
    }


}
