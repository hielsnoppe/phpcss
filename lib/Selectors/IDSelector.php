<?php

namespace NielsHoppe\PHPCSS\Selectors;

/**
 * @see http://www.w3.org/TR/css3-selectors/
 */

class IDSelector extends SimpleSelector {

    protected $id;

    public function __construct ($id) {

        $this->id = $id;
    }

    public function __toString () {

        return '#' . $this->id;
    }

    public function toXPath () {

        return sprintf("[@id='%s']", $this->id);
    }
}
