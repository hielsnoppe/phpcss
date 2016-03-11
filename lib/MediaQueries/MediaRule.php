<?php

/**
 * class NielsHoppe\PHPCSS\MediaQueries\MediaRule
 */

namespace NielsHoppe\PHPCSS\MediaQueries;

use NielsHoppe\PHPCSS\Syntax\RuleList;
use NielsHoppe\PHPCSS\Syntax\Rules\AtRule;

class MediaRule extends AtRule {

    /**
     * @var string $keyword  Keyword
     */

    protected static $keyword = 'media';

    /**
     * Construct a MediaRule
     */

    public function __construct ($queries, $rules) {

        $this->values = array(new MediaQueryList());
        $this->block = new RuleList();
    }
}
