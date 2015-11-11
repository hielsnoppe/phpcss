<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

class Ruleset extends Statement {

    private $selector;
    private $declarations;

    public function __construct ($selector = null) {

        $this->selector = $selector;
        $this->declarations = array();
    }

    /**
     * @return Declaration
     */

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

    /**
     * @param Declaration $declaration
     */

    public function addDeclaration (Declaration $declaration) {

        array_push($this->declarations, $declaration);
    }

    /**
     * @param string $property
     * @param string $value
     */

    public function createDeclaration ($property, $value) {

        $this->addDeclaration(new Declaration($property, $value));
    }

    /**
     * @param string[] $filter
     * @return Declaration[]
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
     * @return string
     */

    public function __toString () {

        $str = implode('; ', array_map('strval', $this->declarations));

        if ($this->selector) {

            $str = sprintf('%s { %s }', $this->selector, $str);
        }

        return $str;
    }
}
