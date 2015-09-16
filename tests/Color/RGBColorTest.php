<?php

namespace NielsHoppe\PHPCSS\Color;

class RGBColorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider    validInputForCreation
     */

    public function testCanBeCreatedFromValidInput ($red, $green, $blue, $alpha) {

        $color = new RGBColor($red, $green, $blue, $alpha);

        $this->assertInstanceOf(RGBColor::class, $color);

        return $color;
    }

    /**
     * @TODO:           What should happen with invalid input?
     * @dataProvider    invalidInputForCreation
     */

    public function testCanNotBeCreatedFromInvalidInput ($red, $green, $blue, $alpha) {

        //$this->setExpectedException('Exception', $message);

        $color = new RGBColor($red, $green, $blue, $alpha);
    }

    /**
     * @dataProvider    validInputForCreation
     *
     * #depends         testCanBeCreatedFromValidInput
     *                  Sadly this is not supported by PHPUnit
     */

    public function testCanBeSerializedToHexString ($red, $green, $blue, $alpha, $hex) {

        $color = new RGBColor($red, $green, $blue, $alpha);

        $string = $color->toHexString();

        $this->assertEquals($hex, $string);
    }

    /**
     * @dataProvider    validInputForCreation
     *
     * #depends         testCanBeCreatedFromValidInput
     *                  Sadly this is not supported by PHPUnit
     */

    public function testCanBeSerializedToRGBString ($red, $green, $blue, $alpha, $hex, $rgb) {

        $color = new RGBColor($red, $green, $blue, $alpha);

        $string = $color->toString();

        $this->assertEquals($rgb, $string);
    }

    public function validInputForCreation () {

        return array(

        /*
         * Add test cases in the following form:
         *
         * 'DESCRIPTION' =>
         *     array(RED, GREEN, BLUE, ALPHA, 'HEXSERIALIZATION', 'RGBSERIALIZATION')
         */

        // without alpha value

        'black without alpha' =>
            array(   0,    0,    0, null, '#000000', 'rgb(0, 0, 0)'),
        'average color without alpha' =>
            array( 127,  127,  127, null, '#7f7f7f', 'rgb(127, 127, 127)'),
        'white without alpha' =>
            array( 255,  255,  255, null, '#ffffff', 'rgb(255, 255, 255)'),
        'out of bounds color without alpha' =>
            array(-127,  127,  383, null, '#007fff', 'rgb(0, 127, 255)'),

        // with alpha value

        'black fully transparent' =>
            array(   0,    0,    0,  0.0, '#000000', 'rgba(0, 0, 0, 0.00)'),
        'average color half transparent' =>
            array( 127,  127,  127,  0.5, '#7f7f7f', 'rgba(127, 127, 127, 0.50)'),
        'white no transparency' =>
            array( 255,  255,  255,  1.0, '#ffffff', 'rgb(255, 255, 255)'),
        'white fully transparent' =>
            array( 255,  255,  255,  0.0, '#ffffff', 'rgba(255, 255, 255, 0.00)'),
        'out of bounds color with alpha exceeding lower bound' =>
            array(-127,  127,  383, -0.5, '#007fff', 'rgba(0, 127, 255, 0.00)'),
        'out of bounds color with alpha exceeding upper bound' =>
            array( 383,  127, -127,  1.5, '#ff7f00', 'rgb(255, 127, 0)')
        );
    }

    public function invalidInputForCreation () {

        return array(
            array(null, 0, 0, 0)
        );
    }
}
