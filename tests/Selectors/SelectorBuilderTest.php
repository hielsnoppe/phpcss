<?php

namespace NielsHoppe\PHPCSS\Selectors;

use \NielsHoppe\PHPCSS\Selectors\SelectorBuilder as SelectorBuilder;

class SelectorBuilderTest extends \PHPUnit_Framework_TestCase {

    /**
     */

    public function testCreatesCorrectSelector () {

        $sb = new SelectorBuilder('p');
        $sb
            ->hasClass('intro')
            ->descendants('span')
            ->attr('id')
            ->prefix('rangy')
            ->suffix('123');

        $selector = $sb->getSelector();

        $this->assertEquals("p.intro span[id ^= 'rangy'][id $= '123']", $selector->__toString());
    }
}
