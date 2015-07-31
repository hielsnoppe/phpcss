<?php

namespace NielsHoppe\PHPCSS;

interface Value {

    public function toString();
}

class IntegerValue implements Value {

}

class NumberValue implements Value {

}

class Unit {

    public static parse ($unit) {

        if (in_array($unit, array(
            'em', // relative
            'ex', // relative
            'in', // absolute
            'cm', // ...
            'mm',
            'pt',
            'pc',
            'px',
            null
        ))) {

            return $unit;
        }
        else {

            throw new InvalidUnitException();
        }
    }
}

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

class PercentageValue implements Value {

}

class URIValue implements Value {

}

class ColorValue implements Value {

    /*
    maroon #800000
    red #ff0000
    orange #ffA500
    yellow #ffff00
    olive #808000
    purple #800080
    fuchsia #ff00ff
    white #ffffff
    lime #00ff00
    green #008000
    navy #000080
    blue #0000ff
    aqua #00ffff
    teal #008080
    black #000000
    silver #c0c0c0
    gray #808080
    */
}

class StringValue implements Value {

}
