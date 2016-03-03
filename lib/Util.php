<?php

/**
 * class NielsHoppe\PHPCSS\Util
 */

namespace NielsHoppe\PHPCSS;

/**
 * Library for utility functions
 */

class Util {

    /**
     * Clips a given value to a range specified by min and max
     *
     * @param int|float $min
     * @param int|float $max
     * @param int|float $value
     *
     * @return int|float
     */

    public static function clip ($min, $max, $value) {

        return max($min, min($max, $value));
    }
}
