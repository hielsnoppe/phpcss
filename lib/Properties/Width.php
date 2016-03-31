<?php

namespace NielsHoppe\PHPCSS\Properties;

use \NielsHoppe\PHP\Properties\Values\KeywordValue;

class Width extends AbstractProperty {

    const $name = 'width';

    public static $acceptedValueTypes = array(
        'LengthValue',
        'PercentageValue',
        KeywordValue::class
    );

    public static $acceptedKeywords = array(
        KeywordValue::IDENT_AUTO,
        KeywordValue::IDENT_INHERIT
    );
}
