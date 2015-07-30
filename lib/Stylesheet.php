<?php

namespace NielsHoppe\PHPCSS;

class Stylesheet {

    private $statements; // Ruleset or AtRule

    public function __construct () {

        $this->statements = array();
    }

}
