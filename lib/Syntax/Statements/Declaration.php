<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

/**
 * @see https://www.w3.org/TR/CSS21/syndata.html#declaration
 */

class Declaration {

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
     * Parse a Declaration from a string
     *
     * @param string      $string
     * @return Declaration
     */

    public static function parse ($string) {

        $parts = explode(':', $string);

        if (count($parts) !== 2) {

            throw new \Exception('Invalid Declaration \'' . $string . '\'.');
        }

        $property = trim($parts[0]);
        $value = trim($parts[1]);

        $result = new Declaration($property, $value);

        return $result;
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
