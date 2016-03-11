<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\RuleList
 */

namespace NielsHoppe\PHPCSS\Syntax;

/**
 * RuleList
 * @see https://www.w3.org/TR/css3-syntax/#rule-list-diagram
 */

class RuleList {

    /**
     * @var Rule[] $rules  A list of rules
     */

    private $rules;

    /**
     * Construct a RuleList from an array of Rules
     *
     * @param Rule[] $rules
     */

    public function __construct ($rules = array()) {

        $this->rules = $rules;
    }

    /**
     * Adds a Rule to this RuleList
     *
     * @param Rule $rule
     */

    public function addRule (Rule $rule) {

        array_push($this->rules, $rule);
    }

    /**
     * Shorthand for creating and adding a rule to this RuleList
     *
     * @param string $property
     * @param string $value
     * @param bool $important
     */
    /* @TODO Copied from DeclarationList!

    public function createRule ($property, $value, $important = false) {

        $this->addRule(new Rule($property, $value, $important));
    }
    */

    /**
     * Get the rules in this list
     *
     * @param string[] $filter
     * @return Rule[]
     */
    /* @TODO Copied from DeclarationList!

    public function getRules ($filter = array()) {

        if (count($filter)) {

            $result = array();

            foreach ($this->rules as $rule) {

                if (in_array($rule->getProperty(), $filter)) {

                    array_push($result, $rule);
                }
            }

            return $result;
        }

        return $this->rules;
    }
    */

    /**
     * Return string representation
     *
     * @return string
     */

    public function __toString () {

        return implode("\n", array_map('strval', $this->rules));
    }
}
