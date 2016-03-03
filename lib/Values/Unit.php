<?php

namespace NielsHoppe\PHPCSS\Values;

/**
 *
 */

class Unit {

    /**
     * Parse a unit from a string
     *
     * @param string $unit
     * @return Unit
     *
     * @throws InvalidUnitException
     */

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
