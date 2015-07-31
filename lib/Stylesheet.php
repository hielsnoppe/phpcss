<?php

namespace NielsHoppe\PHPCSS;

class Stylesheet {

    private $statements; // Ruleset or AtRule

    public function __construct () {

        $this->statements = array();
    }

    public function addStatement ($statement) {

        array_push($this->statements, $statement);
    }

    public function toString () {

        $toStringFunc = function ($statement) {

            return $statement->toString();
        };

        return implode("\n", array_map($toStringFunc, $this->statements));
    }
}
