<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

use \NielsHoppe\PHPCSS\Parser\Parser;
use \NielsHoppe\PHPCSS\Syntax\StyleRule;

class StyleRuleTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider    validInputForParsing
     */

    public function testCanBeSerialized ($string, $css) {

        $rs = Parser::parseRule($string);

        $this->assertEquals($css, strval($rs));
    }

    public function validInputForParsing () {

        return array(

            array(
                'font-size: 12px; color: #ff0000',
                'font-size: 12px; color: #ff0000'
            ),

            array(
                'font-size: 12px; color: #ff0000;',
                'font-size: 12px; color: #ff0000'
            ),

            array(
                'body { font-size: 12px; color: #ff0000 }',
                'body { font-size: 12px; color: #ff0000 }'
            ),
        );
    }
}
