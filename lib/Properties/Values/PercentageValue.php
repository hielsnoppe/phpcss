<?php

namespace NielsHoppe\PHPCSS\Properties\Values;

class PercentageValue {

    protected $value;

    public function __construct ($value) {

        // TODO Validation
        $this->value = $value;
    }

    public function __toString () {

        return sprintf('%d\%', $this->value);
    }
}
