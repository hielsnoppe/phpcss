<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\Rules\QualifiedRule
 */

namespace NielsHoppe\PHPCSS\Syntax\Rules;

use NielsHoppe\PHPCSS\Syntax\Rule;

/**
 * QualifiedRule
 * @see https://www.w3.org/TR/css-syntax-3/#qualified-rule
 */

abstract class QualifiedRule implements Rule {

    /**
     * @var $prelude  A list of component values
     */

    protected $prelude;

    /**
     * @var $block  A simple {} block
     */

    protected $block;
}
