<?php

namespace NielsHoppe\PHPCSS\Syntax\Rules;

use NielsHoppe\PHPCSS\Syntax\Rule;

/**
 * @see https://www.w3.org/TR/css-syntax-3/#qualified-rule
 */

abstract class QualifiedRule implements Rule {

    /**
     * @var $prelude  a list of component values
     * @var $block  a simple {} block
     */

    protected $prelude;
    protected $block;
}
