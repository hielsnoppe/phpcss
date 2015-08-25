<?php

namespace NielsHoppe\PHPCSS\Values;

/**
 * TODO: Implement percent values
 */

class RGBColor {

    private $red;
    private $green;
    private $blue;
    private $alpha;

    public function __construct ($red, $green, $blue, $alpha = null) {

        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
        $this->alpha = $alpha;
    }

    public function toHexString () {

        return sprintf('#%02x%02x%02x', $this->red, $this->green, $this->blue);
    }

    public function toString () {

        if ($this->alpha) {

            return sprintf('rgba(%u, %u, %u, %.2F)', $this->red, $this->green, $this->blue, $this->alpha);
        }

        return sprintf('rgb(%u, %u, %u)', $this->red, $this->green, $this->blue);
    }
}
