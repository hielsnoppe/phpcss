<?php

namespace NielsHoppe\PHPCSS\Color;

use NielsHoppe\PHPCSS\Util;

/**
 * @TODO Implement percent values
 */

class RGBColor {

    /**
     * @var int $red  The amount of red
     */

    private $red;

    /**
     * @var int $green  The amount of green
     */

    private $green;

    /**
     * @var int $blue  The amount of blue
     */

    private $blue;

    /**
     * @var float|null $alpha  Alpha value between 0.0 and 1.0
     */

    private $alpha;

    /**
     * @param int $red  The amount of red
     * @param int $green  The amount of green
     * @param int $blue  The amount of blue
     * @param float|null $alpha  Alpha value between 0.0 and 1.0
     */

    public function __construct ($red, $green, $blue, $alpha = null) {

        $this->red = Util::clip(0, 255, intval($red));
        $this->green = Util::clip(0, 255, intval($green));
        $this->blue = Util::clip(0, 255, intval($blue));

        if (isset($alpha)) {

            $this->alpha = Util::clip(0.0, 1.0, floatval($alpha));
        }
        else {

            $this->alpha = 1.0;
        }
    }

    /**
     * Get a representation as a hexadecimal number
     *
     * @return string
     */

    public function toHexString () {

        return sprintf('#%02x%02x%02x', $this->red, $this->green, $this->blue);
    }

    /**
     * Get a string representation
     *
     * @return string
     */

    public function __toString () {

        if ($this->alpha < 1.0) {

            return sprintf('rgba(%u, %u, %u, %.2F)', $this->red, $this->green, $this->blue, $this->alpha);
        }

        return sprintf('rgb(%u, %u, %u)', $this->red, $this->green, $this->blue);
    }
}
