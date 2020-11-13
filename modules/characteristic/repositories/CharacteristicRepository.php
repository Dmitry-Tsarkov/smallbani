<?php


namespace app\modules\characteristic\repositories;


use app\modules\characteristic\models\Characteristic;
use DomainException;
use RuntimeException;

class CharacteristicRepository
{
    public function save(Characteristic $characteristic): void
    {
        if (!$characteristic->save()) {
            throw new RuntimeException('Characteristic saving error');
        }
    }

    public function getById($id): Characteristic
    {
        if (!$characteristic = Characteristic::findOne($id)) {
            throw new DomainException('Характеристика не найдена');
        }

        return $characteristic;
    }

    public function delete(Characteristic $characteristic): void
    {
        if ($characteristic->delete() === false) {
            throw new RuntimeException('Characteristic deleting error');
        }
    }



}
