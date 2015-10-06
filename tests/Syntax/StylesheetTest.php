<?php

namespace NielsHoppe\PHPCSS\Syntax;

use \NielsHoppe\PHPCSS\Syntax\Stylesheet;
use \NielsHoppe\PHPCSS\Syntax\Statements\Ruleset;
use \NielsHoppe\PHPCSS\Values\ColorValue;

class StylesheetTest extends \PHPUnit_Framework_TestCase {

    public function testMain () {

        $style = new Stylesheet();

        $html = new Ruleset('html');
        $html->createDeclaration('color', new ColorValue('#00f'));

        $body = new Ruleset('body');
        $body->createDeclaration('background-color', new ColorValue('rgba(128, 255 , 0, 0.5)'));
        $body->createDeclaration('padding-top', '10px');

        $style->addStatement($html);
        $style->addStatement($body);

        $expected = <<<CSS
html { color: #0000ff }
body { background-color: #80ff00; padding-top: 10px }
CSS;
        $actual = $style->__toString();

        $this->assertEquals($expected, $actual);
    }
}
