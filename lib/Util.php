<?php

namespace NielsHoppe\PHPCSS;

class Util {

    public static function clip ($min, $max, $value) {

        return max($min, min($max, $value));
    }
}
