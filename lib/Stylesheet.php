<?php

namespace NielsHoppe\PHPCSS;

class Stylesheet {

    private $imports;       // @import (special AtRule)
    private $statements;    // Ruleset or AtRule (except @import)

    public function __construct () {

        $this->imports = array();
        $this->statements = array();
    }

    public function addImport (ImportStatement $import) {

        array_push($this->imports, $import);
    }

    public function addStatement ($statement) {

        array_push($this->statements, $statement);
    }

    public function toString () {

        $toStringFunc = function ($item) {

            return $item->toString();
        };

        $parts = array();

        array_push($parts, implode("\n", array_map($toStringFunc, $this->imports)));
        array_push($parts, implode("\n", array_map($toStringFunc, $this->statements)));

        return implode("\n", array_filter($parts));
    }
}
