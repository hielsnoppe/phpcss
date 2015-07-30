<?php

namespace NielsHoppe\PHPCSS;

class Declaration {

    private $property;
    private $value;

    public function __construct ($property, $value) {

        $this->property = $property;
        $this->value = $value;
    }

    public function toString () {
        return sprintf('%s: %s', $this->property, $this->value);
    }
}
