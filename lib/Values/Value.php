<?php

namespace NielsHoppe\PHPCSS\Values;

interface Value {

    public function toString();
}

class Unit {

    public static function parse ($unit) {

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
