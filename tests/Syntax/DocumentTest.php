<?php

namespace NielsHoppe\PHPCSS\Syntax;

use \NielsHoppe\PHPCSS\Syntax\Document;
use \NielsHoppe\PHPCSS\Syntax\Rules\ImportRule;
use \NielsHoppe\PHPCSS\Syntax\Rules\StyleRule;

class DocumentTest extends \PHPUnit_Framework_TestCase {

    public function testMain () {

        $style = new Document();

        $font = new ImportRule('https://fonts.googleapis.com/css?family=Open+Sans');

        $html = new StyleRule('html');
        $html->createDeclaration('color', '#0000ff');

        $body = new StyleRule('body');
        //$body->createDeclaration('background-color', 'rgba(128, 255 , 0, 0.5)');
        $body->createDeclaration('background-color', '#80ff00');
        $body->createDeclaration('padding-top', '10px');

        $style->addImport($font);
        $style->addRule($html);
        $style->addRule($body);

        $expected = <<<CSS
@import url("https://fonts.googleapis.com/css?family=Open+Sans");
html { color: #0000ff }
body { background-color: #80ff00; padding-top: 10px }
CSS;
        $actual = strval($style);

        $this->assertEquals($expected, $actual);
    }
}
