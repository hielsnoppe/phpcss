#!/usr/bin/php
<?php

require_once('lib/Ruleset.php');
require_once('lib/Declaration.php');

use \NielsHoppe\PHPCSS\Ruleset as Ruleset;

$rs = new Ruleset('foo');
$rs->addDeclaration('margin-top', 0);
$rs->addDeclaration('background-color', '#ff0000');
echo($rs->toString());
