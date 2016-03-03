# phpcss

[![Build Status](https://travis-ci.org/hielsnoppe/phpcss.svg?branch=master)](https://travis-ci.org/hielsnoppe/phpcss)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hielsnoppe/phpcss/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hielsnoppe/phpcss/?branch=master)

This is a PHP library to easily create valid CSS.

It is planned to support converting CSS selectors to XPath aswell as writing rules from stylesheets inline.

## Installation

To install this library via [Composer](http://getcomposer.org) add the following to your `composer.json` and then run `composer update`:

```json
{
    "minimum-stability": "dev",
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/hielsnoppe/phpcss.git"
        }
    ],
    "require": {
        "hielsnoppe/phpcss": "0.1.5"
    }
}
```

## Usage

Given that you have the Composer autoloader in place, you can use PHPCSS as follows:

```php
<?php

use \NielsHoppe\PHPCSS\Document;
use \NielsHoppe\PHPCSS\StyleRule;
use \NielsHoppe\PHPCSS\Values\ColorValue;

$style = new Document();

$html = new StyleRule('html');
$html->createDeclaration('color', new ColorValue('#00f'));

$body = new StyleRule('body');
$body->createDeclaration('background-color', new ColorValue('rgba(128, 255 , 0, 0.5)'));
$body->createDeclaration('padding-top', '10px');

$style->addStatement($html);
$style->addStatement($body);

echo($style);
```

# Documentation and testing

You can create documentation with phpDocumentor as follows:

```
$ composer docs
```

This will create extensive HTML documentation in the `docs/` folder.

You can run the PHPUnit tests as follows:

```
$ composer test
```
