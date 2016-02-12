<?php

namespace NielsHoppe\PHPCSS\Syntax;

/**
 * Objects implementing this interface are required to have a method __toString()
 * that will output valid CSS.
 */

interface Object {

    /**
     * Return a string representation
     *
     * @return string
     */

    public function __toString ();
}