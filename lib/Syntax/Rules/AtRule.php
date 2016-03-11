<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\Rules\AtRule
 */

namespace NielsHoppe\PHPCSS\Syntax\Rules;

use NielsHoppe\PHPCSS\Syntax\Rule;

/**
 * AtRule
 * @see https://www.w3.org/TR/css3-syntax/#at-rule
 */

abstract class AtRule implements Rule {

    /**
     * @var string $keyword  Keyword
     */

    protected static $keyword;

    /**
     * @var mixed[] $values  Component values
     */

    protected $values;

    /**
     * @var mixed $block  Block
     */

    protected $block;

    /**
     * Construct a new AtRule
     *
     * @param mixed[] $values  A list of component values
     * @param mixed $block  A block
     */

    public function __construct ($values = array(), $block = null) {

        $this->values = $values;
        $this->block = $block;
    }

    /**
     * Return string representation
     *
     * @return string
     */

    public function __toString () {

        if ($this->block === null) {

            $result = sprintf('@%s %s;', static::$keyword, implode(' ', array_map('strval', $this->values)));
        }
        else {

            $result = sprintf('@%s %s %s', static::$keyword, implode(' ', array_map('strval', $this->values)), $this->block);
        }

        return $result;
    }
}
