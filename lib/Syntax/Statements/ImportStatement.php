<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

use NielsHoppe\PHPCSS\Syntax\Statements\AtRuleStatement;

/**
 * @see https://www.w3.org/TR/CSS21/cascade.html#at-import
 */

class ImportStatement extends AtRuleStatement {

    /**
     * @param string $url
     * @param string|[string] $media
     */

    public function __construct ($url, $media = null) {

        $this->keyword = 'import';
        $this->content = sprintf('url(%s)', $url);

        if (isset($media)) {

            if (!is_array($media)) {

                $media = array($media);
            }
        }
        else {

            $this->media = array('all');
        }

        if (!in_array('all', $media)) {

            $this->content .= ' ' . implode(', ', $media);
        }

        $this->content .= ';';
    }
}
