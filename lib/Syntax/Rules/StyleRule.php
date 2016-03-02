<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\Rules\StyleRule
 */

namespace NielsHoppe\PHPCSS\Syntax\Rules;

use NielsHoppe\PHPCSS\Syntax\DeclarationList;

/**
 * StyleRule
 * @see https://www.w3.org/TR/css-syntax-3/#style-rule
 */

class StyleRule extends QualifiedRule {

    /**
     * Construct a new StyleRule
     *
     * @param string $selector
     * @param DeclarationList $declarations
     */

    public function __construct ($selector = null, DeclarationList $declarations = null) {

        $this->prelude = $selector;

        if (is_null($declarations)) {

            $declarations = new DeclarationList();
        }

        $this->block = $declarations;
    }

    /**
     * Adds a Declaration to this StyleRule
     *
     * @param Declaration $declaration
     */

    public function addDeclaration (Declaration $declaration) {

        $this->block->addDeclaration($declaration);
    }

    /**
     * Shorthand for creating and adding a declaration to this StyleRule
     *
     * @param string $property
     * @param string $value
     */

    public function createDeclaration ($property, $value) {

        $this->block->createDeclaration($property, $value);
    }

    /**
     * Return all declarations from this style rule
     *
     * @param string[] $filter
     * @return Declaration[]
     */

    public function getDeclarations ($filter = array()) {

        return $this->block->getDeclarations($filter);
    }

    /**
     * Return string representation
     *
     * @return string
     */

    public function __toString () {

        $str = strval($this->block);

        if ($this->prelude) {

            $str = sprintf('%s { %s }', $this->prelude, $str);
        }

        return $str;
    }
}
