<?php

namespace NielsHoppe\PHPCSS\Properties;

abstract class AbstractProperty implements Property {

    public static $acceptedValueTypes = array();
    public static $acceptedKeywords = array();

    public function acceptsValue ($value) {

        foreach ($this->acceptedValueTypes as $class) {

            if ($value instanceof $class) {

                return true;
            }
        }
    }
}
