<?php


namespace app\modules\characteristic\helpers;


use app\modules\characteristic\models\Characteristic;

class CharacteristicHelper
{
    public static function TypeList()
    {
        return [
            Characteristic::TYPE_DROP_DOWN => 'Выпадающий спиок',
            Characteristic::TYPE_TEXT => 'Поле ввода',
        ];
    }
}
