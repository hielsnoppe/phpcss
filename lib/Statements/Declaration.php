<?php

namespace NielsHoppe\PHPCSS\Statements;

class Declaration {

    private $property;
    private $value;

    public function __construct ($property, $value) {

        $this->property = $property;
        $this->value = $value;
    }

    public function __toString () {

        $value = is_object($this->value) ? $this->value->__toString() : $this->value;

        return sprintf('%s: %s', $this->property, $value);
    }
}
