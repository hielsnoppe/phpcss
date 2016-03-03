# phpcss

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hielsnoppe/phpcss/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hielsnoppe/phpcss/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/hielsnoppe/phpcss/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/hielsnoppe/phpcss/?branch=develop)
[![Build Status](https://scrutinizer-ci.com/g/hielsnoppe/phpcss/badges/build.png?b=master)](https://scrutinizer-ci.com/g/hielsnoppe/phpcss/build-status/master)

This is a PHP library to easily create valid CSS.

## Current state and roadmap

This library is currently under active development.
The next milestone is a stable release (version 1.0.0) with a reduced feature set.
Later it is planned to support converting CSS selectors to XPath aswell as writing rules from stylesheets inline.

## Installation

To install this library via [Composer](https://getcomposer.org/) add the following to your `composer.json` and then run `composer update`:

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

This library will be available on [Packagist](https://packagist.org/) as soon as version 1.0.0 is released.

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

You can create documentation with [phpDocumentor](https://www.phpdoc.org/) as follows:

```
$ composer docs
```

This will create extensive HTML documentation in the `docs/` folder.

You can run the [PHPUnit](https://phpunit.de/) tests as follows:

```
$ composer test
```
