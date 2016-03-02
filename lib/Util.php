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
     * @param int $min
     * @param int $max
     * @param int $value
     *
     * @return int
     */

    public static function clip ($min, $max, $value) {

        return max($min, min($max, $value));
    }
}
