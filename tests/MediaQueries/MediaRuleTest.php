<?php

namespace NielsHoppe\PHPCSS\MediaQueries;

use NielsHoppe\PHPCSS\Syntax\RuleList;
use NielsHoppe\PHPCSS\Syntax\Rules\StyleRule;

class MediaRuleTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider  validInputForCreation
     */

    public function testCanBeCreatedFromValidInput ($queries, $selector, $property, $value) {

        $style = new StyleRule($selector);
        $style->createDeclaration($property, $value);

        $rule = new MediaRule($queries, new RuleList(array( $style )));

        $this->assertInstanceOf(MediaRule::class, $rule);
    }

    /**
     * @dataProvider  validInputForCreation
     */

    public function testCanBeSerialized ($queries, $selector, $property, $value, $css) {

        $style = new StyleRule($selector);
        $style->createDeclaration($property, $value);

        $rule = new MediaRule($queries, new RuleList(array( $style )));

        $this->assertEquals($css, strval($rule));
    }

    public function validInputForCreation () {

        return array(

            array('all', 'body', 'color', '#ff0000',
                '@media all { body { color: #ff0000; } }')
        );
    }
}
