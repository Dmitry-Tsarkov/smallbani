<?php


namespace app\modules\feedback\models;


class FeedbackStatus
{
    public const NEW = 1;
    public const DONE = 0;

    private $value;


    public function __construct($value)
    {
        if (!in_array($value, array_keys(self::list()))) {
            throw new \DomainException('Некоректный статус');
        }
        $this->value = $value;
    }

    public static function new(): self
    {
        return new self(self::NEW);
    }

    public static function list()
    {
        return [
            self::NEW => 'Новый',
            self::DONE => 'Выполнен',
        ];
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isNew(): bool
    {
        return $this->value == self::NEW;
    }

    public function getLabel()
    {
        return self::list()[$this->value];
    }
}
