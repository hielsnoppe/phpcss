<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\Declaration
 */

namespace NielsHoppe\PHPCSS\Syntax;

use NielsHoppe\PHPCSS\Syntax\Item;

/**
 * Declaration
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
     * @var bool $important  The important flag
     */

    private $important;

    /**
     * Construct a Declaration from a Property and a Value
     *
     * @param Property    $property
     * @param Value       $value
     */

    public function __construct ($property, $value, $important = false) {

        $this->property = $property;
        $this->value = $value;
        $this->important = $important;
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
     * Return state of important flag of this Declaration
     *
     * @return bool
     */

    public function isImportant () {

        return $this->important;
    }

    /**
     * Return string representation
     *
     * @return string
     */

    public function __toString () {

        $value = is_object($this->value) ? $this->value->__toString() : $this->value;

        return trim(sprintf('%s: %s %s', $this->property, $value, $this->important ? '!important' : ''));
    }
}
