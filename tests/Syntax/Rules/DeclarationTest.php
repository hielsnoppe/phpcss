<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

use \NielsHoppe\PHPCSS\Parser\Parser;
use \NielsHoppe\PHPCSS\Syntax\Statements\Declaration;

class DeclarationTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider    validInputForParsing
     */

    public function testCanBeSerialized ($string, $css) {

        $rs = Parser::parseDeclaration($string);

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
}
