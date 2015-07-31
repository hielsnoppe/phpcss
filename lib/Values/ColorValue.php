<?php

namespace NielsHoppe\PHPCSS\Values;

/**
 * Does not support percent values
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

            return sprintf('rgba(%u, %u, %u, %u)', $this->red, $this->green, $this->blue, $this->alpha);
        }

        return sprintf('rgb(%u, %u, %u)', $this->red, $this->green, $this->blue);
    }
}

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

class ColorValue implements Value {

    const OUTPUT_MODE_HEX   = 0;
    const OUTPUT_MODE_RGB   = 1;
    const OUTPUT_MODE_RGBA  = 2;
    const OUTPUT_MODE_HSL   = 3;
    const OUTPUT_MODE_HSLA  = 4;

    /*
    // Illegal in PHP 5.5.9
    // Available in PHP 5.6
    const KEYWORD_HEX_VALUE = array(
        'aqua' => '#00ffff',
        'black' => '#000000',
        'blue' => '#0000ff',
        'fuchsia' => '#ff00ff',
        'gray' => '#808080',
        'green' => '#008000',
        'lime' => '#00ff00',
        'maroon' => '#800000',
        'navy' => '#000080',
        'olive' => '#808000',
        'orange' => '#ffA500',
        'purple' => '#800080',
        'red' => '#ff0000',
        'silver' => '#c0c0c0',
        'teal' => '#008080',
        'white' => '#ffffff',
        'yellow' => '#ffff00'
    );
    */

    private $color;

    public function __construct ($value) {

        /*
        $subPatterns = array(
            'hex' => '[a-zA-Z0-9]',
            'hexhex' => '[a-zA-Z0-9]{2}',
            'int' => '[0-9]{1,3}',
            'perc' => '[0-9]{1,3}%'
        );
        */

        $patterns = array(
            'hex' => '/^#(?P<red>[a-zA-Z0-9])(?P<green>[a-zA-Z0-9])(?P<blue>[a-zA-Z0-9])$/',
            'hexhex' => '/^#(?P<red>[a-zA-Z0-9]{2})(?P<green>[a-zA-Z0-9]{2})(?P<blue>[a-zA-Z0-9]{2})$/',
            'rgb' => '/^rgb\((?P<red>[0-9]{1,3}),(?P<green>[0-9]{1,3}),(?P<blue>[0-9]{1,3})\)$/',
            /*
            'rgba' => '/^rgba\((?P<red>[0-9]{1,3}),(?P<green>[0-9]{1,3}),(?P<blue>),(?P<alpha>)\)$/',
            'hsl' => '/^hsl\((?P<hue>),(?P<saturation>),(?P<lightness>)\)$/',
            'hsla' => '/^hsla\((?P<hue>),(?P<saturation>),(?P<lightness>),(?P<alpha>)\)$/',
            */
        );

        foreach ($patterns as $name => $pattern) {

            preg_match($pattern, $value, $matches);

            if (!count($matches)) {

                continue;
            }

            switch ($name) {

            case 'hex':

                $this->color = new RGBColor(
                    hexdec($matches['red'] . $matches['red']),
                    hexdec($matches['green'] . $matches['green']),
                    hexdec($matches['blue'] . $matches['blue'])
                );

                break 2;

            case 'hexhex':

                $this->color = new RGBColor(
                    hexdec($matches['red']),
                    hexdec($matches['green']),
                    hexdec($matches['blue'])
                );

                break 2;

            case 'rgb':

                $matches['alpha'] = null;

            case 'rgba':

                $this->color = new RGBColor($matches['red'], $matches['green'], $matches['blue'], $matches['alpha']);

                break 2;

            case 'hsl':
            case 'hsla':

                // TODO

                break 2;
            }
        }

        if (!$this->color) {

            throw new \Exception('Unsupported color format');
        }
    }

    public function toString ($outputMode = self::OUTPUT_MODE_HEX) {

        switch ($outputMode) {

        case self::OUTPUT_MODE_RGB:

            return $this->color->toString();

        case self::OUTPUT_MODE_HEX:
        default:

            return $this->color->toHexString();
        }
    }
}
