<?php

namespace app\modules\feedback\models;

use DomainException;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class Phone
{
    /** @var PhoneNumber */
    private $phoneNumber;

    public function __construct($code, $number)
    {
        $this->phoneNumber = new PhoneNumber();
        $this->phoneNumber->setCountryCode($code);
        $this->phoneNumber->setNationalNumber($number);
    }

    public static function createFromString($string): Phone
    {
        if (!self::isValidPhone($string)) {
            throw new DomainException('Некорректный телефон');
        }

        try {
            $phoneUtil = PhoneNumberUtil::getInstance();
            $swissNumberProto = $phoneUtil->parse($string, "RU");
            return new self($swissNumberProto->getCountryCode(), $swissNumberProto->getNationalNumber());
        } catch (NumberParseException $e) {
            throw new DomainException($e->getMessage());
        }
    }

    public static function isValidPhone($string): bool
    {
        try {
            $phoneUtil = PhoneNumberUtil::getInstance();
            $swissNumberProto = $phoneUtil->parse($string, "RU");
            return $phoneUtil->isValidNumber($swissNumberProto);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getNumber()
    {
        return $this->phoneNumber->getNationalNumber();
    }

    public function getCode()
    {
        return $this->phoneNumber->getCountryCode();
    }

    public function getFormattedNumber()
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        return $phoneUtil->format($this->phoneNumber, PhoneNumberFormat::INTERNATIONAL);
    }
}
