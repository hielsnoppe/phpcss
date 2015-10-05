<?php

namespace NielsHoppe\PHPCSS\Statements;

class Ruleset extends Statement {

    private $selector;
    private $declarations;

    public function __construct ($selector = null) {

        $this->selector = $selector;
        $this->declarations = array();
    }

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

    public function addDeclaration ($property, $value) {

        array_push($this->declarations, new Declaration($property, $value));
    }

    public function getDeclarations () {

        return $this->declarations;
    }

    public function __toString () {

        $str = implode('; ', array_map('strval', $this->declarations));

        if ($this->selector) {

            $str = sprintf('%s { %s }', $this->selector, $str);
        }

        return $str;
    }
}
