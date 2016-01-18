<?php

namespace NielsHoppe\PHPCSS\Selectors;

/**
 * @see http://www.w3.org/TR/css3-selectors/
 */

class ClassSelector extends SimpleSelector {

    protected $class;

    public function __construct ($class) {

        $this->class = $class;
    }

    public function __toString () {

        return '.' . $this->class;
    }

    public function toXPath () {

        return sprintf("[contains(concat(' ', normalize-space(@class), ' '), concat(' ', '%s', ' '))]", $this->class);
    }
}
