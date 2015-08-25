<?php

namespace NielsHoppe\PHPCSS\Values;

/**
 * http://stackoverflow.com/a/20440417/948404
 * http://stackoverflow.com/questions/2353211/hsl-to-rgb-color-conversion
 */

class HSLColor {

    private $hue;
    private $saturation;
    private $lightness;
    private $alpha;

    public function __construct ($hue, $saturation, $lightness, $alpha = null) {

        $this->hue = $hue;
        $this->saturation = $saturation;
        $this->lightness = $lightness;
        $this->alpha = $alpha;
    }

    public function toString () {

        // Wrong!

        if ($this->alpha) {

            return sprintf('hsla(%u, %u, %u, %u)', $this->hue, $this->saturation, $this->lightness, $this->alpha);
        }

        return sprintf('hsl(%u, %u, %u)', $this->hue, $this->saturation, $this->lightness);
    }
}
