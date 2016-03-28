<?php

namespace NielsHoppe\PHPCSS\Properties;

abstract class AbstractProperty implements Property {

    public static $name = '';
    public static $acceptedValueTypes = array();
    public static $acceptedKeywords = array();

    protected $value;

    public function acceptsValue ($value) {

        foreach ($this->acceptedValueTypes as $class) {

            if ($value instanceof $class) {

                return true;
            }
        }
    }

    public function getValue () {

        return $this->value;
    }

    public function setValue ($value) {

        // check validity
        // sanitize
        if (static::acceptsValue($value)) {

            $this->value = $value;
        }
        else {

            // throw Exception
        }
    }
}
