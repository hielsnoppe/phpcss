<?php

namespace NielsHoppe\PHPCSS\Selectors;

/**
 * @see http://www.w3.org/TR/css3-selectors/
 */

class Selector {

    const DESCENDANT_COMBINATOR = ' '; // also TAB, LINE FEED, CARRIAGE RETURN, FORM FEED
    const CHILD_COMBINATOR = ' > ';
    const GENERAL_SIBLING_COMBINATOR = ' ~ ';
    const ADJACENT_SIBLING_COMBINATOR = ' + ';

    protected $chain; // of one or more sequences of simple selectors separated by combinators

    public function __construct ($chain) {

        $this->chain = $chain;
    }

    /**
     * @see http://www.w3.org/TR/css3-selectors/#specificity
     * @see http://www.w3.org/TR/2009/CR-CSS2-20090908/cascade.html#specificity
     * Specificity of style="" is always 1000
     */

    public function getSpecificity () {

        $specificity = 0;

        foreach ($this->chain as $item) {

            if ($item instanceof IDSelector) {

                $specificity += 100;
            }
            else if (
                $item instanceof ClassSelector ||
                $item instanceof AttributeSelector ||
                $item instanceof PseudoClassSelector
            ) {

                $specificity += 10;
            }
            else if ($item instanceof TypeSelector) {
                // TODO: Account for pseudo-elements

                $specificity += 1;
            }
        }

        return $specificity;
    }

    public function toString () {

        $result = '';

        foreach ($this->chain as $item) {

            if (is_string($item)) {

                $result .= $item;
            }
            else {

                $result .= $item->toString();
            }
        }

        return $result;
    }

    public function toXPath () {

        return '';
    }
}
