#!/usr/bin/php
<?php

require_once('lib/Stylesheet.php');
require_once('lib/Ruleset.php');
require_once('lib/Declaration.php');
require_once('lib/Values/Value.php');
require_once('lib/Values/ColorValue.php');
require_once('lib/Values/ValueFormatException.php');

use \NielsHoppe\PHPCSS\Stylesheet as Stylesheet;
use \NielsHoppe\PHPCSS\Ruleset as Ruleset;
use \NielsHoppe\PHPCSS\Values\ColorValue as ColorValue;

$style = new Stylesheet();

$html = new Ruleset('html');
$html->addDeclaration('color', new ColorValue('#00f'));

$body = new Ruleset('body');
$body->addDeclaration('background-color', new ColorValue('rgb(128, 255 , 0)'));
$body->addDeclaration('padding-top', 10);

$style->addStatement($html);
$style->addStatement($body);

echo($style->toString());
