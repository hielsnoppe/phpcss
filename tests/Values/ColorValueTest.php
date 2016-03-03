<?php

namespace NielsHoppe\PHPCSS\Values;

class ColorValueTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider    validStringsForCreation
     */

    public function testCanBeCreatedFromValidString ($string) {

        $value = new ColorValue($string);

        $this->assertInstanceOf(ColorValue::class, $value);

        return $value;
    }

    /**
     * @dataProvider    invalidStringsForCreation
     */

    public function testCanNotBeCreatedFromInvalidString ($string, $message) {

        $this->setExpectedException('Exception', $message);

        $value = new ColorValue($string);
    }

    public function validStringsForCreation () {

        return array(
            array('#fc0'),
            array('#ffcc00'),
            array('rgb(128, 255 , 0)'),
            array('rgba(128, 255 , 0, 0.5)')
        );
    }

    public function invalidStringsForCreation () {

        return array(
            array('#ffcc0', 'Unsupported color format'),
            array('asdf', 'Unsupported color format'),
            array('rgb(128, 255 , 0, 0.5)', 'Unsupported color format')
        );
    }
}
