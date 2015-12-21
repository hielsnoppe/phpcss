<?php

namespace NielsHoppe\PHPCSS\Selectors;

use \NielsHoppe\PHPCSS\Selectors\ClassSelector as ClassSelector;
use \NielsHoppe\PHPCSS\Selectors\IDSelector as IDSelector;
use \NielsHoppe\PHPCSS\Selectors\Selector as Selector;
use \NielsHoppe\PHPCSS\Selectors\TypeSelector as TypeSelector;
use \NielsHoppe\PHPCSS\Selectors\UniversalSelector as UniversalSelector;

class SelectorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider selectorsFromSpecSpecificity
     */

    public function testCalculateSpecificity ($chain, $specificity) {

        $selector = new Selector($chain);

        $this->assertEquals($specificity, $selector->getSpecificity());
    }

    /**
     * @dataProvider selectorsFromHakreXPath
     */

    public function testTransformToXPath ($chain, $xpath) {

        $selector = new Selector($chain);

        $this->assertEquals($xpath, $selector->toXPath());
    }

    /**
     * @see https://hakre.wordpress.com/2012/03/18/css-selector-to-xpath-conversion/
     */

    public function selectorsFromHakreXPath () {

        return array(
            array(array(
                new UniversalSelector()
            ), '//*'),

            array(array(
                new TypeSelector('P')
            ), '//P'),

            array(array(
                new TypeSelector('BODY')
            ), '//BODY'),

            array(array(
                new TypeSelector('P'),
                new AttributeSelector('align')
            ), '//P[@align]'),

            array(array(
                new TypeSelector('P'),
                new AttributeSelector('class', 'intro', AttributeSelector::MATCH_INCLUDES)
            ), "//P[contains(concat(' ', normalize-space(@class), ' '), concat(' ', 'intro', ' '))]"),

            array(array(
                new TypeSelector('P'),
                new ClassSelector('intro')
            ), "//P[contains(concat(' ', normalize-space(@class), ' '), concat(' ', 'intro', ' '))]"),

            array(array(
                new TypeSelector('P'),
                new AttributeSelector('align', 'le', AttributeSelector::MATCH_PREFIX)
            ), "//P[starts-with(@align, 'le')]"),

            array(array(
                new TypeSelector('P'),
                new AttributeSelector('align', 't', AttributeSelector::MATCH_SUFFIX)
            ), "//P[substring(@align, string-length(@align), 1) = 't']"),

            array(array(
                new TypeSelector('P'),
                new AttributeSelector('align', 'igh', AttributeSelector::MATCH_SUBSTRING)
            ), "//P[contains(@align, 'igh')]"),

            array(array(
                new TypeSelector('P'),
                new AttributeSelector('lang', 'en', AttributeSelector::MATCH_DASH)
            ), "//P[@lang = 'en' or starts-with(@lang, 'en-')]"),

            array(array(
                new TypeSelector('P'),
                Selector::DESCENDANT_COMBINATOR,
                new UniversalSelector()
            ), '//P//*'),

            array(array(
                new TypeSelector('P'),
                Selector::CHILD_COMBINATOR,
                new UniversalSelector()
            ), '//P/*')
        );
    }

    /**
     * @see http://www.w3.org/TR/css3-selectors/#specificity
     */

    public function selectorsFromSpecSpecificity () {

        return array(
            array(array(
                new UniversalSelector()
            ), 0),

            array(array(
                new TypeSelector('LI')
            ), 1),

            array(array(
                new TypeSelector('UL'),
                Selector::DESCENDANT_COMBINATOR,
                new TypeSelector('LI')
            ), 2),

            array(array(
                new TypeSelector('UL'),
                Selector::DESCENDANT_COMBINATOR,
                new TypeSelector('OL'),
                Selector::ADJACENT_SIBLING_COMBINATOR,
                new TypeSelector('LI')
            ), 3),

            array(array(
                new TypeSelector('H1'),
                Selector::ADJACENT_SIBLING_COMBINATOR,
                new UniversalSelector(),
                new AttributeSelector('REL', 'up')
            ), 11),

            array(array(
                new TypeSelector('UL'),
                Selector::DESCENDANT_COMBINATOR,
                new TypeSelector('OL'),
                Selector::DESCENDANT_COMBINATOR,
                new TypeSelector('LI'),
                new ClassSelector('red')
            ), 13),

            array(array(
                new TypeSelector('LI'),
                new ClassSelector('red'),
                new ClassSelector('level')
            ), 21),

            array(array(
                new IDSelector('x34y')
            ), 100),

            /*
            array(array(
                new IDSelector('s12'),
                new PseudoClassSelector()
            ), 101)
            */
        );
    }
}
