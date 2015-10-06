<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

use \NielsHoppe\PHPCSS\Syntax\Statements\Declaration;

class DeclarationTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider    validInputForParsing
     */

    public function testCanBeCreatedFromValidInput ($string) {

        $rs = Declaration::parse($string);

        $this->assertInstanceOf(Declaration::class, $rs);
    }

    /**
     * @dataProvider    invalidInputForParsing
     */

    public function testThrowsExceptionParsingInvalidInput ($string, $message) {

        $this->setExpectedException('Exception', $message);

        $rs = Declaration::parse($string);
    }

    /**
     * @dataProvider    validInputForParsing
     */

    public function testCanBeSerialized ($string, $css) {

        $rs = Declaration::parse($string);

        $this->assertEquals($css, strval($rs));
    }

    public function validInputForParsing () {

        return array(

            array(
                'font-size: 12px',
                'font-size: 12px'
            ),

            array(
                'color: #ff0000',
                'color: #ff0000'
            )
        );
    }

    public function invalidInputForParsing () {

        return array(

            array(
                'font-size 12px',
                'Invalid Declaration \'font-size 12px\'.'
            )
        );
    }
}
