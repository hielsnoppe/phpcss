<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

use \NielsHoppe\PHPCSS\Syntax\StyleRule;

class StyleRuleTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider    validInputForParsing
     */

    public function testCanBeCreatedFromValidInput ($string) {

        $rs = StyleRule::parse($string);

        $this->assertInstanceOf(StyleRule::class, $rs);
    }

    /**
     * @dataProvider    invalidInputForParsing
     */

    public function testThrowsExceptionParsingInvalidInput ($string, $message) {

        $this->setExpectedException('Exception', $message);

        $rs = StyleRule::parse($string);
    }

    /**
     * @dataProvider    validInputForParsing
     */

    public function testCanBeSerialized ($string, $css) {

        $rs = StyleRule::parse($string);

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

    public function invalidInputForParsing () {

        return array(

            array(
                'body { font-size: 12px; color: #ff0000 } asdf',
                'Extra content after closing bracket: \' asdf\''
            )
        );
    }
}
