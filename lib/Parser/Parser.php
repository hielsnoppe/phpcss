<?php

namespace NielsHoppe\PHPCSS\Parser;

use \NielsHoppe\PHPCSS\Syntax\Rules\StyleRule;
use \NielsHoppe\PHPCSS\Syntax\Declaration;
use \NielsHoppe\PHPCSS\Syntax\DeclarationList;

/**
 * Parser for CSS offering entry points as specified in
 * @see https://www.w3.org/TR/css-syntax-3/#parser-entry-points
 *
 * @see https://www.w3.org/TR/css-syntax-3/#parsing
 */

class Parser {

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-stylesheet
     * @todo Implement this
     *
     * @return Syntax\Stylesheet
     */

    public static function parseStylesheet ($string) {
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-list-of-rules
     * @todo Implement this
     *
     * @return Syntax\Rule[]
     */

    public static function parseRuleList ($string) {
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-rule
     * @todo Currently only parses StyleRule
     *
     * @return Syntax\Rule
     */

    public static function parseRule ($string) {

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

        $block = self::parseDeclarationList($body);

        $result = new StyleRule($selector, $block);

        return $result;
    }

    /**
     * Parse a Declaration from a string
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-declaration
     *
     * @param string      $string
     * @return Syntax\Declaration
     */

    public static function parseDeclaration ($string) {

        $parts = explode(':', $string);

        if (count($parts) !== 2) {

            throw new \Exception('Invalid Declaration \'' . $string . '\'.');
        }

        $property = trim($parts[0]);
        $value = trim($parts[1]);
        $important = false; // TODO

        $result = new Declaration($property, $value, $important);

        return $result;
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-list-of-declarations
     *
     * @return Syntax\DeclarationList
     */

    public static function parseDeclarationList ($string) {

        $tokens = array_filter(explode(';', $string));

        $declarations = array_map(function ($token) {

            $declaration = self::parseDeclaration($token);

            return $declaration;
        }, $tokens);

        $result = new DeclarationList($declarations);

        return $result;
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-component-value
     *
     * @return Syntax\ComponentValue
     */

    public static function parseComponentValue ($string) {
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-list-of-component-values
     *
     * @return Syntax\ComponentValue[]
     */

    public static function parseComponentValueList ($string) {
    }
}
