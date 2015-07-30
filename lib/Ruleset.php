<?php

namespace NielsHoppe\PHPCSS;

class Ruleset {

    private $selector;
    private $declarations;

    public function __construct ($selector) {

        $this->selector = $selector;
        $this->declarations = array();
    }

    public function addDeclaration ($property, $value) {

        array_push($this->declarations, new Declaration($property, $value));
    }

    public function toString () {

        $toStringFunc = function ($declaration) {

            return $declaration->toString();
        };

        $str = implode('; ', array_map($toStringFunc, $this->declarations));

        if ($this->selector) {

            $str = sprintf('%s { %s }', $this->selector, $str);
        }

        return $str;
    }
}
