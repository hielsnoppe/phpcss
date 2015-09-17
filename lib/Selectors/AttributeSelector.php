<?php

namespace NielsHoppe\PHPCSS\Selectors;

/**
 * @see http://www.w3.org/TR/css3-selectors/
 */

class AttributeSelector extends SimpleSelector {

    const MATCH_EXACT       = '=';
    const MATCH_DASH        = '|=';
    const MATCH_INCLUDES    = '~=';
    const MATCH_PREFIX      = '^=';
    const MATCH_SUFFIX      = '$=';
    const MATCH_SUBSTRING   = '*=';

    protected $attribute;
    protected $val;
    protected $operator;

    public function __construct ($attribute, $value = null, $operator = null) {

        $this->attribute = $attribute;

        if (isset($value)) {

            $this->value = $value;

            if (
                $operator == self::MATCH_EXACT ||
                $operator == self::MATCH_DASH ||
                $operator == self::MATCH_INCLUDES ||
                $operator == self::MATCH_PREFIX ||
                $operator == self::MATCH_SUFFIX ||
                $operator == self::MATCH_SUBSTRING
            ) {

                $this->operator = $operator;
            }
            else {

                $this->operator = self::MATCH_EXACT;
            }
        }
        else {

            $this->value = null;
            $this->operator = null;
        }
    }

    public function __toString () {

        $result = $this->attribute;

        if (isset($this->value)) {

            $result .= $this->operator . $this->value;
        }

        return '[' . $result . ']';
    }

    public function toXPath () {

        return '';
    }
}
