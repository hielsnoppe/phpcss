<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

use \NielsHoppe\PHPCSS\Syntax\Declaration;
use \NielsHoppe\PHPCSS\Parser\Parser;
use \NielsHoppe\PHPCSS\Syntax\Rules\StyleRule;

class ParserTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider    validInputForParsingStyleRules
     */

    public function testParseRuleFromValidInput ($string) {

        $rs = Parser::parseRule($string);

        $this->assertInstanceOf(StyleRule::class, $rs);
    }

    /**
     * @dataProvider    invalidInputForParsingStyleRules
     */

    public function testParseRuleInvalidInput ($string, $message) {

        $this->setExpectedException('Exception', $message);

        $rs = Parser::parseRule($string);
    }

    /**
     * @dataProvider    validInputForParsingDeclarations
     */

    public function testParseDeclarationFromValidInput ($string) {

        $rs = Parser::parseDeclaration($string);

        $this->assertInstanceOf(Declaration::class, $rs);
    }

    /**
     * @dataProvider    invalidInputForParsingDeclarations
     */

    public function testParseDeclarationFromInvalidInput ($string, $message) {

        $this->setExpectedException('Exception', $message);

        $rs = Parser::parseDeclaration($string);
    }

    public function validInputForParsingStyleRules () {

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

    public function invalidInputForParsingStyleRules () {

        return array(

            array(
                'body { font-size: 12px; color: #ff0000 } asdf',
                'Extra content after closing bracket: \' asdf\''
            )
        );
    }

    public function validInputForParsingDeclarations () {

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

    public function invalidInputForParsingDeclarations () {

        return array(

            array(
                'font-size 12px',
                'Invalid Declaration \'font-size 12px\'.'
            )
        );
    }
}
