<?php

namespace NielsHoppe\PHPCSS\Syntax;

class DeclarationTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider validInputForCreation
     */

    public function testCanBeCreatedFromValidInput ($property, $value, $important) {

        $declaration = new Declaration($property, $value, $important);

        $this->assertInstanceOf(Declaration::class, $declaration);

        return $declaration;
    }

    /**
     * @dataProvider validInputForCreation
     */

    public function testCanBeSerialized ($property, $value, $important, $expected) {

        $declaration = new Declaration($property, $value, $important);

        $this->assertEquals($expected, strval($declaration));
    }

    public function validInputForCreation () {

        return array(

            array(
                'font-size', '12px', null,
                'font-size: 12px'
            ),

            array(
                'font-size', '12px', false,
                'font-size: 12px'
            ),

            array(
                'font-size', '12px', true,
                'font-size: 12px !important'
            )
        );
    }
}
