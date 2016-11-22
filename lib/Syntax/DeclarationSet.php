<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\DeclarationSet
 */

namespace NielsHoppe\PHPCSS\Syntax;

/**
 * DeclarationSet
 * This is a utility without an explicit counterpart from the specification
 */

class DeclarationSet extends DeclarationList {

    /**
     * Construct a DeclarationSet from an array of Declarations
     *
     * @param Declaration[] $declarations
     */

    public function __construct ($declarations = array()) {

        $this->declarations = array();

        foreach ($declarations as $declaration) {

            $this->addDeclaration($declaration);
        }
    }

    /**
     * Adds a Declaration to this DeclarationSet
     *
     * @param Declaration $declaration
     */

    public function addDeclaration (Declaration $declaration) {

        $property = $declaration->getProperty();

        $this->declarations[$property] = $declaration;

        ksort($this->declarations);
    }

    /**
     * Shorthand for creating and adding a declaration to this DeclarationSet
     *
     * @param string $property
     * @param string $value
     * @param bool $important
     */

    public function createDeclaration ($property, $value, $important = false) {

        $this->addDeclaration(new Declaration($property, $value, $important));
    }

    /**
     * Get the declaration for the given property name in this set
     *
     * @param string $property
     * @return Declaration[]
     */

    public function getDeclaration ($property) {

        if (array_key_exists($property, $this->declarations)) {

            return $this->declarations[$property];
        }

        return null;
    }

    /**
     * Get the declarations in this set optionally filtered by property names
     *
     * @param string[] $filter
     * @return Declaration[]
     */

    public function getDeclarations ($filter = array()) {

        if (count($filter)) {

            $result = array();

            foreach ($filter as $property) {

                array_push($result, $this->getDeclaration($property));
            }

            return array_filter($result);
        }

        return array_values($this->declarations);
    }

    /**
     * Calculates the set union of $this and an $other DeclarationSet.
     * For properties present in both DeclarationSets Declarations from $this
     * DeclarationSet take precedence over those in the $other DeclarationSet.
     *
     * @param DeclarationSet $other
     * @return DeclarationSet  Union of $this and $other
     */

    public function union (DeclarationSet $other) {

        $result = new DeclarationSet($other->declarations);

        foreach ($this->declarations as $property => $declaration) {

            $result->addDeclaration($declaration);
        }

        return $result;
    }

    /**
     * Return string representation
     *
     * @return string
     */

    public function __toString () {

        return implode('; ', array_map('strval', array_values($this->declarations)));
    }
}
