<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\Rules\ImportRule
 */

namespace NielsHoppe\PHPCSS\Syntax\Rules;

use NielsHoppe\PHPCSS\Syntax\Rules\AtRule;

/**
 * ImportRule
 * @see https://www.w3.org/TR/css-syntax-3/#at-rule
 */

class ImportRule extends AtRule {

    /**
     * @var string $keyword  Keyword
     */

    protected static $keyword = 'import';

    /**
     * @var string $media  A media description
     */

    private $media;

    /**
     * Construct an ImportRule from a URL and optionally media types
     *
     * @param string $url
     * @param string $media
     */

    public function __construct ($url, $media = '') {

        $this->values = array(sprintf('url("%s")', $url));

        if ($media !== null && $media !== '' && $media !== 'all') {

            array_push($this->values, $media);
        }
    }
}
