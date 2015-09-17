<?php

namespace NielsHoppe\PHPCSS\Color;

class HSLColorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider    validInputForCreation
     */

    public function testCanBeCreatedFromValidInput ($hue, $sat, $light, $alpha) {

        $color = new HSLColor($hue, $sat, $light, $alpha);

        $this->assertInstanceOf(HSLColor::class, $color);

        return $color;
    }

    /**
     * @TODO:           What should happen with invalid input?
     * @dataProvider    invalidInputForCreation
     */
    /*

    public function testCanNotBeCreatedFromInvalidInput ($hue, $sat, $light, $alpha) {

        //$this->setExpectedException('Exception', $message);

        $color = new HSLColor($hue, $sat, $light, $alpha);
    }
    */

    /**
     * @dataProvider    validInputForCreation
     *
     * #depends         testCanBeCreatedFromValidInput
     *                  Sadly this is not supported by PHPUnit
     */

    public function testCanBeConvertedToRGBColor ($hue, $sat, $light, $alpha, $rgbString) {

        $hsl = new HSLColor($hue, $sat, $light, $alpha);

        $rgb = $hsl->toRGBColor();

        $this->assertInstanceOf(RGBColor::class, $rgb);

        $string = $rgb->__toString();

        $this->assertEquals($rgbString, $string);
    }

    public function validInputForCreation () {

        return array(

        /*
         * Add test cases in the following form:
         *
         * 'DESCRIPTION' =>
         *     array(HUE, SATURATION, LIGHTNESS, ALPHA, 'RGBSERIALIZATION')
         *
         * http://webdesign.about.com/od/color/ss/hsl-colors.htm
         */

        // without alpha value

        /*
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        */

        'silver without alpha' =>
            array(   0,    0,   75, null, 'rgb(192, 192, 192)'),
        'gray without alpha' =>
            array(   0,    0,   50, null, 'rgb(128, 128, 128)'),

        /*
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        'black without alpha' =>
            array(   0,  100,  100, null, 'rgb(0, 0, 0)'),
        */

        'black without alpha' =>
            array(   0,    0,    0, null, 'rgb(0, 0, 0)'),
        'white without alpha' =>
            array(   0,    0,  100, null, 'rgb(255, 255, 255)'),
        );
    }

    public function invalidInputForCreation () {

        return array(
        );
    }
}
