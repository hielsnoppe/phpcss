<?php

namespace NielsHoppe\PHPCSS\Syntax;

/**
 */

class Document implements Item {

    /**
     * @var ImportRule @import (special AtRule)
     * @var [StyleRule|AtRule]    StyleRule or AtRule (except @import)
     */

    private $imports;
    private $rules;

    public function __construct () {

        $this->imports = array();
        $this->rules = array();
    }

    /**
     * @param ImportRule   $import
     */

    public function addImport (ImportRule $import) {

        array_push($this->imports, $import);
    }

    /**
     * @param Rule     $rule
     */

    public function addRule ($rule) {

        array_push($this->rules, $rule);
    }

    /**
     * @return string
     */

    public function __toString () {

        $toStringFunc = function ($item) {

            return $item->__toString();
        };

        $parts = array();

        array_push($parts, implode("\n", array_map($toStringFunc, $this->imports)));
        array_push($parts, implode("\n", array_map($toStringFunc, $this->rules)));

        return implode("\n", array_filter($parts));
    }
}
