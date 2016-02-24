<?php

namespace NielsHoppe\PHPCSS\Syntax;

use NielsHoppe\PHPCSS\Syntax\Item;

/**
 * @see https://www.w3.org/TR/css-syntax-3/#declaration
 */

class Declaration implements Item {

    /**
     * @var string $property  The declared Property
     */

    private $property;

    /**
     * @var Values\Value $value  The declared Value
     */

    private $value;

    /**
     * Construct a Declaration from a Property and a Value
     *
     * @param Property    $property
     * @param Value       $value
     */

    public function __construct ($property, $value) {

        $this->property = $property;
        $this->value = $value;
    }

    /**
     * Return property part of this Declaration
     *
     * @return Property
     */

    public function getProperty () {

        return $this->property;
    }

    /**
     * Return value part of this Declaration
     *
     * @return Value
     */

    public function getValue () {

        return $this->value;
    }

    /**
     * Return string representation
     *
     * @return string
     */

    public function __toString () {

        $value = is_object($this->value) ? $this->value->__toString() : $this->value;

        return sprintf('%s: %s', $this->property, $value);
    }
}
