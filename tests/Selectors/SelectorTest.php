<?php

namespace NielsHoppe\PHPCSS\Selectors;

use \NielsHoppe\PHPCSS\Selectors\Selector as Selector;
use \NielsHoppe\PHPCSS\Selectors\TypeSelector as TypeSelector;
use \NielsHoppe\PHPCSS\Selectors\ClassSelector as ClassSelector;
use \NielsHoppe\PHPCSS\Selectors\IDSelector as IDSelector;

class SelectorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider selectorsFromSpecSpecificity
     */

    public function testCalculateSpecificity ($chain, $specificity) {

        $selector = new Selector($chain);

        $this->assertEquals($specificity, $selector->getSpecificity());
    }

    /**
     * @dataProvider selectorsFromSpecSpecificity
     */

    public function testTransformToXPath ($chain, $specificity, $xpath) {

        $this->markTestIncomplete();

        $selector = new Selector($chain);

        $this->assertEquals($xpath, $selector->toXPath());
    }

    /**
     * @see http://www.w3.org/TR/css3-selectors/#specificity
     */

    public function selectorsFromSpecSpecificity () {

        return array(
            array(array(
                new UniversalSelector()
            ), 0, ''),

            array(array(
                new TypeSelector('LI')
            ), 1, ''),

            array(array(
                new TypeSelector('UL'),
                Selector::DESCENDANT_COMBINATOR,
                new TypeSelector('LI')
            ), 2, ''),

            array(array(
                new TypeSelector('UL'),
                Selector::DESCENDANT_COMBINATOR,
                new TypeSelector('OL'),
                Selector::ADJACENT_SIBLING_COMBINATOR,
                new TypeSelector('LI')
            ), 3, ''),

            array(array(
                new TypeSelector('H1'),
                Selector::ADJACENT_SIBLING_COMBINATOR,
                new UniversalSelector(),
                new AttributeSelector('REL', 'up')
            ), 11, ''),

            array(array(
                new TypeSelector('UL'),
                Selector::DESCENDANT_COMBINATOR,
                new TypeSelector('OL'),
                Selector::DESCENDANT_COMBINATOR,
                new TypeSelector('LI'),
                new ClassSelector('red')
            ), 13, ''),

            array(array(
                new TypeSelector('LI'),
                new ClassSelector('red'),
                new ClassSelector('level')
            ), 21, ''),

            array(array(
                new IDSelector('x34y')
            ), 100, ''),

            /*
            array(array(
                new IDSelector('s12'),
                new PseudoClassSelector()
            ), 101, '')
            */
        );
    }
}
