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
            'rgba' => '/^rgb\(\s*(?P<red>[0-9]{1,3})\s*,\s*(?P<green>[0-9]{1,3})\s*,\s*(?P<blue>[0-9]{1,3})\s*\,\s*(?P<alpha>[0-1]\.[0-9]{1,2})\s*\)$/',
            /*
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
                    'yellow' => '#ffff00',

                    /**
                     * Extended color keywords
                     * @see http://www.w3.org/wiki/CSS3/Color/Extended_color_keywords
                     */

                    'aliceblue' => '#F0F8FF',
                    'antiquewhite' => '#FAEBD7',
                    //'aqua' => '#00FFFF',
                    'aquamarine' => '#7FFFD4',
                    'azure' => '#F0FFFF',
                    'beige' => '#F5F5DC',
                    'bisque' => '#FFE4C4',
                    //'black' => '#000000',
                    'blanchedalmond' => '#FFEBCD',
                    //'blue' => '#0000FF',
                    'blueviolet' => '#8A2BE2',
                    'brown' => '#A52A2A',
                    'burlywood' => '#DEB887',
                    'cadetblue' => '#5F9EA0',
                    'chartreuse' => '#7FFF00',
                    'chocolate' => '#D2691E',
                    'coral' => '#FF7F50',
                    'cornflowerblue' => '#6495ED',
                    'cornsilk' => '#FFF8DC',
                    'crimson' => '#DC143C',
                    'cyan' => '#00FFFF',
                    'darkblue' => '#00008B',
                    'darkcyan' => '#008B8B',
                    'darkgoldenrod' => '#B8860B',
                    'darkgray' => '#A9A9A9',
                    'darkgreen' => '#006400',
                    'darkgrey' => '#A9A9A9',
                    'darkkhaki' => '#BDB76B',
                    'darkmagenta' => '#8B008B',
                    'darkolivegreen' => '#556B2F',
                    'darkorange' => '#FF8C00',
                    'darkorchid' => '#9932CC',
                    'darkred' => '#8B0000',
                    'darksalmon' => '#E9967A',
                    'darkseagreen' => '#8FBC8F',
                    'darkslateblue' => '#483D8B',
                    'darkslategray' => '#2F4F4F',
                    'darkslategrey' => '#2F4F4F',
                    'darkturquoise' => '#00CED1',
                    'darkviolet' => '#9400D3',
                    'deeppink' => '#FF1493',
                    'deepskyblue' => '#00BFFF',
                    'dimgray' => '#696969',
                    'dimgrey' => '#696969',
                    'dodgerblue' => '#1E90FF',
                    'firebrick' => '#B22222',
                    'floralwhite' => '#FFFAF0',
                    'forestgreen' => '#228B22',
                    //'fuchsia' => '#FF00FF',
                    'gainsboro' => '#DCDCDC',
                    'ghostwhite' => '#F8F8FF',
                    'gold' => '#FFD700',
                    'goldenrod' => '#DAA520',
                    //'gray' => '#808080',
                    //'green' => '#008000',
                    'greenyellow' => '#ADFF2F',
                    'grey' => '#808080',
                    'honeydew' => '#F0FFF0',
                    'hotpink' => '#FF69B4',
                    'indianred' => '#CD5C5C',
                    'indigo' => '#4B0082',
                    'ivory' => '#FFFFF0',
                    'khaki' => '#F0E68C',
                    'lavender' => '#E6E6FA',
                    'lavenderblush' => '#FFF0F5',
                    'lawngreen' => '#7CFC00',
                    'lemonchiffon' => '#FFFACD',
                    'lightblue' => '#ADD8E6',
                    'lightcoral' => '#F08080',
                    'lightcyan' => '#E0FFFF',
                    'lightgoldenrodyellow' => '#FAFAD2',
                    'lightgray' => '#D3D3D3',
                    'lightgreen' => '#90EE90',
                    'lightgrey' => '#D3D3D3',
                    'lightpink' => '#FFB6C1',
                    'lightsalmon' => '#FFA07A',
                    'lightseagreen' => '#20B2AA',
                    'lightskyblue' => '#87CEFA',
                    'lightslategray' => '#778899',
                    'lightslategrey' => '#778899',
                    'lightsteelblue' => '#B0C4DE',
                    'lightyellow' => '#FFFFE0',
                    //'lime' => '#00FF00',
                    'limegreen' => '#32CD32',
                    'linen' => '#FAF0E6',
                    'magenta' => '#FF00FF',
                    //'maroon' => '#800000',
                    'mediumaquamarine' => '#66CDAA',
                    'mediumblue' => '#0000CD',
                    'mediumorchid' => '#BA55D3',
                    'mediumpurple' => '#9370DB',
                    'mediumseagreen' => '#3CB371',
                    'mediumslateblue' => '#7B68EE',
                    'mediumspringgreen' => '#00FA9A',
                    'mediumturquoise' => '#48D1CC',
                    'mediumvioletred' => '#C71585',
                    'midnightblue' => '#191970',
                    'mintcream' => '#F5FFFA',
                    'mistyrose' => '#FFE4E1',
                    'moccasin' => '#FFE4B5',
                    'navajowhite' => '#FFDEAD',
                    //'navy' => '#000080',
                    'oldlace' => '#FDF5E6',
                    //'olive' => '#808000',
                    'olivedrab' => '#6B8E23',
                    //'orange' => '#FFA500',
                    'orangered' => '#FF4500',
                    'orchid' => '#DA70D6',
                    'palegoldenrod' => '#EEE8AA',
                    'palegreen' => '#98FD98',
                    'paleturquoise' => '#AFEEEE',
                    'palevioletred' => '#DB7093',
                    'papayawhip' => '#FFEFD5',
                    'peachpuff' => '#FFDAB9',
                    'peru' => '#CD853F',
                    'pink' => '#FFC0CD',
                    'plum' => '#DDA0DD',
                    'powderblue' => '#B0E0E6',
                    //'purple' => '#800080',
                    //'red' => '#FF0000',
                    'rosybrown' => '#BC8F8F',
                    'royalblue' => '#4169E1',
                    'saddlebrown' => '#8B4513',
                    'salmon' => '#FA8072',
                    'sandybrown' => '#F4A460',
                    'seagreen' => '#2E8B57',
                    'seashell' => '#FFF5EE',
                    'sienna' => '#A0522D',
                    //'silver' => '#C0C0C0',
                    'skyblue' => '#87CEEB',
                    'slateblue' => '#6A5ACD',
                    'slategray' => '#708090',
                    'slategrey' => '#708090',
                    'snow' => '#FFFAFA',
                    'springgreen' => '#00FF7F',
                    'steelblue' => '#4682B4',
                    'tan' => '#D2B48C',
                    //'teal' => '#008080',
                    'thistle' => '#D8BFD8',
                    'tomato' => '#FF6347',
                    'turquoise' => '#40E0D0',
                    'saddlebrown' => '#8B4513',
                    'violet' => '#EE82EE',
                    'wheat' => '#F5DEB3',
                    //'white' => '#FFFFFF',
                    'whitesmoke' => '#F5F5F5',
                    //'yellow' => '#FFFF00',
                    'yellowgreen' => '#9ACD32',
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

    public function toString ($outputMode = self::OUTPUT_MODE_RGB) {

        switch ($outputMode) {

        case self::OUTPUT_MODE_RGB:

            return $this->color->toString();

        case self::OUTPUT_MODE_HEX:
        default:

            return $this->color->toHexString();
        }
    }
}
