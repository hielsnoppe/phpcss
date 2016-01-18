<?php

namespace NielsHoppe\PHPCSS\Selectors;

/**
 * @see http://www.w3.org/TR/css3-selectors/
 */

class UniversalSelector extends SimpleSelector {

    public function __construct () {}

    public function __toString () {

        return '*';
    }

    public function toXPath () {

        return '*';
    }
}
