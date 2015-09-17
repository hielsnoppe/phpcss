<?php

namespace NielsHoppe\PHPCSS\Color;

use NielsHoppe\PHPCSS\Util as Util;

/**
 * TODO: Implement percent values
 */

class RGBColor {

    private $red;
    private $green;
    private $blue;
    private $alpha;

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

    public function toHexString () {

        return sprintf('#%02x%02x%02x', $this->red, $this->green, $this->blue);
    }

    public function __toString () {

        if ($this->alpha < 1.0) {

            return sprintf('rgba(%u, %u, %u, %.2F)', $this->red, $this->green, $this->blue, $this->alpha);
        }

        return sprintf('rgb(%u, %u, %u)', $this->red, $this->green, $this->blue);
    }
}
