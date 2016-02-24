<?php

namespace NielsHoppe\PHPCSS\Syntax;

use \NielsHoppe\PHPCSS\Syntax\Document;
use \NielsHoppe\PHPCSS\Syntax\Rules\StyleRule;
use \NielsHoppe\PHPCSS\Values\ColorValue;

class DocumentTest extends \PHPUnit_Framework_TestCase {

    public function testMain () {

        $style = new Document();

        $html = new StyleRule('html');
        $html->createDeclaration('color', new ColorValue('#00f'));

        $body = new StyleRule('body');
        $body->createDeclaration('background-color', new ColorValue('rgba(128, 255 , 0, 0.5)'));
        $body->createDeclaration('padding-top', '10px');

        $style->addRule($html);
        $style->addRule($body);

        $expected = <<<CSS
html { color: #0000ff }
body { background-color: #80ff00; padding-top: 10px }
CSS;
        $actual = $style->__toString();

        $this->assertEquals($expected, $actual);
    }
}
