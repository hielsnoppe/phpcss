<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

/**
 * @see https://www.w3.org/TR/CSS21/syndata.html#rule-sets
 * @see https://www.w3.org/TR/css-syntax-3/#style-rule
 */

class Ruleset extends Statement {

    /**
     * @var $selector
     * @var Declaration[] $declarations
     */

    private $selector;
    private $declarations;

    public function __construct ($selector = null) {

        $this->selector = $selector;
        $this->declarations = array();
    }

    /**
     * Parses a StyleRule from a string
     *
     * @return Declaration
     */

    public static function parse ($string) {

        $result = new Ruleset();

        $selector = null;
        $parts = array_filter(explode('{', $string));

        if (count($parts) > 1) {

            $selector = trim($parts[0]);
            $parts = array_filter(explode('}', $parts[1]));

            if (count($parts) > 1) {

                throw new \Exception('Extra content after closing bracket: \'' . $parts[1] . '\'');
            }
        }

        $body = trim($parts[0]);

        $tokens = array_filter(explode(';', $string));

        $declarations = array_map(function ($token) {

            $declaration = Declaration::parse($token);

            return $declaration;
        }, $tokens);

        $result->declarations = $declarations;

        return $result;
    }

    /**
     * Adds a Declaration to this StyleRule
     *
     * @param Declaration $declaration
     */

    public function addDeclaration (Declaration $declaration) {

        array_push($this->declarations, $declaration);
    }

    /**
     * Shorthand for creating and adding a declaration to this StyleRule
     *
     * @param string $property
     * @param string $value
     */

    public function createDeclaration ($property, $value) {

        $this->addDeclaration(new Declaration($property, $value));
    }

    /**
     * Return all declarations from this style rule
     *
     * @param string[] $filter
     * @return Declaration[]
     */

    public function getDeclarations ($filter = array()) {

        if (count($filter)) {

            $result = array();

            foreach ($this->declarations as $declaration) {

                if (in_array($declaration->getProperty(), $filter)) {

                    array_push($result, $declaration);
                }
            }

            return $result;
        }

        return $this->declarations;
    }

    /**
     * Return string representation
     *
     * @return string
     */

    public function __toString () {

        $str = implode('; ', array_map('strval', $this->declarations));

        if ($this->selector) {

            $str = sprintf('%s { %s }', $this->selector, $str);
        }

        return $str;
    }
}
