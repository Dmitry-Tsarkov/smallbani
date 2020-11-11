<?php


namespace app\modules\characteristic\services;


use app\modules\characteristic\forms\CharacteristicCreateForm;
use app\modules\characteristic\forms\CharacteristicEditForm;
use app\modules\characteristic\forms\VariantForm;
use app\modules\characteristic\models\Characteristic;
use app\modules\characteristic\models\Variant;
use app\modules\characteristic\repositories\CharacteristicRepository;

class CharacteristicService
{
    private $characteristics;

    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function create(CharacteristicCreateForm $form): Characteristic
    {
        $characteristic = Characteristic::create(
            $form->title,
            $form->unit,
            $form->type
        );

        $this->characteristics->save($characteristic);
        return $characteristic;
    }

    public function edit($id, CharacteristicEditForm $form)
    {
        $characteristic = $this->characteristics->getById($id);
        $characteristic->edit($form->title, $form->unit);
        $this->characteristics->save($characteristic);
    }

    public function delete($id)
    {
        $characteristic = $this->characteristics->getById($id);
        $this->characteristics->delete($characteristic);
    }

    public function addVariant($id, VariantForm $createForm)
    {
        $characteristic = $this->characteristics->getById($id);
        $characteristic->addVariant(
            Variant::create($characteristic->id, $createForm->value)
        );
        $this->characteristics->save($characteristic);
    }

    public function editVariant($characteristicId, $variantId, VariantForm $form)
    {
        $characteristic = $this->characteristics->getById($characteristicId);
        $characteristic->editVariant($variantId, $form->value);
        $this->characteristics->save($characteristic);
    }

    public function deleteVariant($characteristicId, $variantId)
    {
        $characteristic = $this->characteristics->getById($characteristicId);
        $characteristic->removeVariant($variantId);
        $this->characteristics->save($characteristic);
    }
}
