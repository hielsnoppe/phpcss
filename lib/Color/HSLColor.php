<?php

namespace NielsHoppe\PHPCSS\Color;

/**
 * @see http://stackoverflow.com/a/20440417/948404
 * @see http://stackoverflow.com/questions/2353211/hsl-to-rgb-color-conversion
 */

class HSLColor {

    /**
     * @var int $hue
     */

    private $hue;

    /**
     * @var int $saturation
     */

    private $saturation;

    /**
     * @var int $lightness
     */

    private $lightness;

    /**
     * @var float|null $alpha  Alpha value between 0.0 and 1.0
     */

    private $alpha;

    /**
     * @param int $hue
     * @param int $saturation
     * @param int $lightness
     * @param float|null $alpha  Alpha value between 0.0 and 1.0
     */

    public function __construct ($hue, $saturation, $lightness, $alpha = null) {

        $this->hue = $hue;
        $this->saturation = $saturation;
        $this->lightness = $lightness;

        if (isset($alpha)) {

            $this->alpha = Util::clip(0.0, 1.0, floatval($alpha));
        }
        else {

            $this->alpha = 1.0;
        }
    }

    /**
     *
     */

    public function huetorgb ($m1, $m2, $hue) {

        if ($hue < 0) {

            $hue = $hue + 1;
        }

        if ($hue > 1) {

            $hue = $hue - 1;
        }

        if ($hue * 6 < 1) {

            return $m1 + ($m2 - $m1) * $hue * 6;
        }

        if ($hue * 2 < 1) {

            return $m2;
        }

        if ($hue * 3 < 2) {

            return $m1 + ($m2 - $m1) * (2 / 3 - $hue) * 6;
        }

        return $m1;
    }

    /**
     * Get RGB representation
     *
     * @return RGBColor
     */

    public function toRGBColor () {

        if ($this->lightness < 0.5) {

            $m2 = $this->lightness * ($this->saturation + 1);
        }
        else {

            $m2 = $this->lightness + $this->saturation - $this->lightness * $this->saturation;
        }

        $m1 = $this->lightness * 2 - $m2;

        $red = ceil(self::huetorgb($m1, $m2, $this->hue + 1 / 3) / 100 * 255);
        $green = ceil(self::huetorgb($m1, $m2, $this->hue) / 100 * 255);
        $blue = ceil(self::huetorgb($m1, $m2, $this->hue - 1 / 3) / 100 * 255);

        $color = new RGBColor($red, $green, $blue, $this->alpha);

        return $color;
    }

    /**
     * Get string representation
     *
     * @return string
     */

    public function __toString () {

        // FIXME Wrong!

        if ($this->alpha < 1.0) {

            return sprintf('hsla(%u, %u, %u, %.2F)', $this->hue, $this->saturation, $this->lightness, $this->alpha);
        }

        return sprintf('hsl(%u, %u, %u)', $this->hue, $this->saturation, $this->lightness);
    }
}
