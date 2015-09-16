<?php

namespace NielsHoppe\PHPCSS\Statements;

class Declaration {

    private $property;
    private $value;

    public function __construct ($property, $value) {

        $this->property = $property;
        $this->value = $value;
    }

    public function toString () {

        $value = is_object($this->value) ? $this->value->toString() : $this->value;

        return sprintf('%s: %s', $this->property, $value);
    }
}
