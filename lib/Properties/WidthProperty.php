<?php

namespace NielsHoppe\PHPCSS\Properties;

class WidthProperty implements Property {

    public static $acceptedValueTypes = array(
        'LengthValue',
        'PercentageValue',
        'KeywordValue'
    );

    public static $acceptedKeywords = array(
        'auto',
        'inherit'
    );
}
