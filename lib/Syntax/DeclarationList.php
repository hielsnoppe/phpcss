<?php

namespace NielsHoppe\PHPCSS\Syntax;

/**
 * @see https://www.w3.org/TR/css-syntax-3/#declaration
 */

class DeclarationList {

    /**
     * @var string $declarations
     */

    private $declarations;

    /**
     * Construct a DeclarationList from an array of Declarations
     *
     * @param [Declaraton] $declarations
     */

    public function __construct ($declarations = array()) {

        $this->declarations = $declarations;
    }

    /**
     * Adds a Declaration to this DeclarationList
     *
     * @param Declaration $declaration
     */

    public function addDeclaration (Declaration $declaration) {

        array_push($this->declarations, $declaration);
    }

    /**
     * Shorthand for creating and adding a declaration to this DeclarationList
     *
     * @param string $property
     * @param string $value
     */

    public function createDeclaration ($property, $value) {

        $this->addDeclaration(new Declaration($property, $value));
    }

    /**
     * Get the declarations in this list
     *
     * @param [string] $filter
     * @return [Declaration]
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
     * @todo Implement
     *
     * @return string
     */

    public function __toString () {

        return implode('; ', array_map('strval', $this->declarations));
    }
}
