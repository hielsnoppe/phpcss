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

            return sprintf('rgba(%u, %u, %u, %u)', $this->red, $this->green, $this->blue, $this->alpha);
        }

        return sprintf('rgb(%u, %u, %u)', $this->red, $this->green, $this->blue);
    }
}

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
    );
    */

    private $color;

    public function __construct ($value) {

        /*
        $subPatterns = array(
            'hex' => '[a-zA-Z0-9]',
            'hexhex' => '[a-zA-Z0-9]{2}',
            'int' => '[0-9]{1,3}',
            'perc' => '[0-9]{1,3}%',
            'alpha' => '[01]?\.?[0-9]+'
        );
        */

        $patterns = array(
            'keyword' => '/^(?P<keyword>[a-zA-Z]+)$/',
            'hex' => '/^#?(?P<red>[a-zA-Z0-9])(?P<green>[a-zA-Z0-9])(?P<blue>[a-zA-Z0-9])$/',
            'hexhex' => '/^#?(?P<red>[a-zA-Z0-9]{2})(?P<green>[a-zA-Z0-9]{2})(?P<blue>[a-zA-Z0-9]{2})$/',
            'rgb' => '/^rgb\(\s*(?P<red>[0-9]{1,3})\s*,\s*(?P<green>[0-9]{1,3})\s*,\s*(?P<blue>[0-9]{1,3})\s*\)$/',
            /*
            'rgba' => '/^rgb\(\s*(?P<red>[0-9]{1,3})\s*,\s*(?P<green>[0-9]{1,3})\s*,\s*(?P<blue>[0-9]{1,3})\s*\,\s*(?P<alpha>[0-1]\.[0-9]{1,2})\s*\)$/',
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

            case 'keyword':

                $keyword = strtolower($matches['keyword']);

                $keywords = array(

                    /**
                     * transparent
                     * @see http://www.w3.org/wiki/CSS3/Color/transparent
                     *
                     * FIXME: Do not replace with RGBa value because this breaks with OUTPUT_MODE_HEX
                     */

                    'transparent' => 'rgba(0,0,0,0)',

                    /**
                     * Basic color keywords
                     * @see http://www.w3.org/wiki/CSS3/Color/Basic_color_keywords
                     */

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

                    /**
                     * Extended color keywords
                     * @see http://www.w3.org/wiki/CSS3/Color/Extended_color_keywords
                     *
                     * TODO: add extended color keywords
                     */
                );

                if (in_array($keyword, $keywords)) {

                    $value = $keywords[$keyword];
                }

                break 1;

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

                $this->color = new RGBColor(
                    $matches['red'],
                    $matches['green'],
                    $matches['blue'],
                    $matches['alpha']
                );

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
