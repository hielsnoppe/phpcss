<?php

namespace NielsHoppe\PHPCSS\Values;

/**
 * @see https://www.w3.org/TR/css3-values/#length-value
 */

class LengthValue implements Value {

    /**
     * @var NumberValue $value
     * @var string $unit
     */

    private $value; // NumberValue
    private $unit; // string

    /**
     *
     */

    public function __construct ($value, $unit = null) {

        $value = NumberValue::parse($value);
        $unit = Unit::parse($unit); // throws InvalidUnitException

        if (empty($unit) and $value->read() != 0) {

            throw new ValueFormatException(); // missing unit
        }

        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * Return a string representation
     *
     * @return string
     */

    public function __toString () {

        return sprintf('%s%s', $this->value->__toString(), $this->unit);
    }
}
