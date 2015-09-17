<?php

namespace NielsHoppe\PHPCSS\Statements;

class Ruleset extends Statement {

    private $selector;
    private $declarations;

    public function __construct ($selector = null) {

        $this->selector = $selector;
        $this->declarations = array();
    }

    public function addDeclaration ($property, $value) {

        array_push($this->declarations, new Declaration($property, $value));
    }

    public function __toString () {

        $__toStringFunc = function ($declaration) {

            return $declaration->__toString();
        };

        $str = implode('; ', array_map($__toStringFunc, $this->declarations));

        if ($this->selector) {

            $str = sprintf('%s { %s }', $this->selector, $str);
        }

        return $str;
    }
}
