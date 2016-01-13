<?php

namespace NielsHoppe\PHPCSS;

/**
 * Objects implementing this interface are required to have a method __toString()
 * that will output valid CSS.
 *
 * @TODO Rename. This interface is poorly named.
 */

interface Printable {

    /**
     * @return string
     */

    public function __toString ();
}
