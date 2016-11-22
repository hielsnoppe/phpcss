<?php

namespace NielsHoppe\PHPCSS\Color;

/**
 * @see https://en.wikipedia.org/wiki/Hue
 */

class Hue {

    private $value;

    public function __construct ($value) {

        $this->value = $value;
    }

    public function toRGB ($m1, $m2) {

        if ($this->value < 0) {

            $this->value = $this->value + 1;
        }

        if ($this->value > 1) {

            $this->value = $this->value - 1;
        }

        if ($this->value * 6 < 1) {

            return $m1 + ($m2 - $m1) * $this->value * 6;
        }

        if ($this->value * 2 < 1) {

            return $m2;
        }

        if ($this->value * 3 < 2) {

            return $m1 + ($m2 - $m1) * (2 / 3 - $this->value) * 6;
        }

        return $m1;
    }
}
