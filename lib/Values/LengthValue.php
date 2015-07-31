<?php

namespace NielsHoppe\PHPCSS;

class LengthValue implements Value {

    private $value; // NumberValue
    private $unit; // string

    public function __construct ($value, $unit = null) {

        $value = NumberValue::parse($value);
        $unit = Unit::parse($unit); // throws InvalidUnitException

        if (empty($unit) and $value->read() != 0) {

            throw new ValueFormatException(); // missing unit
        }

        $this->value = $value;
        $this->unit = $unit;
    }

    public function toString () {

        return sprintf('%s%s', $this->value->toString(), $this->unit);
    }
}
