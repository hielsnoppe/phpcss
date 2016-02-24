<?php

namespace NielsHoppe\PHPCSS\Values;

/**
 * @see https://www.w3.org/TR/css3-values/#number-value
 */

class NumberValue implements Value {

    /**
     * Return a string representation
     *
     * @return string
     */

    public function __toString () {

        return '';
    }

    public static function parse ($value) {

        return new NumberValue($value);
    }
}
