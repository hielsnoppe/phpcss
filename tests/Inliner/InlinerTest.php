<?php

namespace NielsHoppe\PHPCSS\Inliner;

use \NielsHoppe\PHPCSS\Inliner\Inliner;

class InlinerTest extends \PHPUnit_Framework_TestCase {

    public function testMain () {

        $inliner = new Inliner();

        $inliner->setHtml('<h1>Hallo Welt!</h1>');
        $inliner->setCss('h1{font-weight:bold;}');

        $actual = $inliner->emogrifyBodyContent();
        $expected = '<h1 style="font-weight: bold;">Hallo Welt!</h1>' . "\n";

        $this->assertEquals($expected, $actual);
    }
}
