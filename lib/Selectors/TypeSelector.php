<?php

namespace NielsHoppe\PHPCSS\Selectors;

/**
 * @see http://www.w3.org/TR/css3-selectors/
 */

class TypeSelector extends SimpleSelector {

    protected $name;

    public function __construct ($name) {

        $this->name = $name;
    }

    public function __toString () {

        return $this->name;
    }

    public function toXPath () {

        return $this->name;
    }
}
