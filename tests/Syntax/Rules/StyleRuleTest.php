<?php

namespace NielsHoppe\PHPCSS\Syntax\Rules;

use \NielsHoppe\PHPCSS\Parser\Parser;
use \NielsHoppe\PHPCSS\Syntax\Declaration;
use \NielsHoppe\PHPCSS\Syntax\Rules\StyleRule;

class StyleRuleTest extends \PHPUnit_Framework_TestCase {

    public function testConstruct () {

        $rule = new StyleRule('#test');

        $this->assertAttributeEquals('#test', 'prelude', $rule);

        return $rule;
    }

    /**
     * @depends testConstruct
     */
    public function testAddDeclaration ($rule) {

        $rule->addDeclaration(new Declaration('color', '#ff0000'));

        return $rule;
    }

    /**
     * @depends testAddDeclaration
     */
    public function testCreateDeclaration ($rule) {

        $rule->createDeclaration('color', '#00ff00');

        return $rule;
    }

    /**
     * @depends testCreateDeclaration
     */
    public function testGetDeclarations ($rule) {

        $declarations = $rule->getDeclarations();
    }

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
