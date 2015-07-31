#!/usr/bin/php
<?php

require_once('lib/Ruleset.php');
require_once('lib/Declaration.php');
require_once('lib/Values/Value.php');
require_once('lib/Values/ColorValue.php');
require_once('lib/Values/ValueFormatException.php');

use \NielsHoppe\PHPCSS\Ruleset as Ruleset;
use \NielsHoppe\PHPCSS\Values\ColorValue as ColorValue;

$rs = new Ruleset('html');
$rs->addDeclaration('margin-top', 0);
$rs->addDeclaration('background-color', new ColorValue('rgb(128,255,0)'));

echo($rs->toString());
