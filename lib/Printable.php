<?php

namespace NielsHoppe\PHPCSS;

/**
 * TODO: Rename. This interface is poorly named.
 * Objects implementing this interface are required to have a method __toString()
 * that will output valid CSS.
 */

interface Printable {

    public function __toString ();
}
