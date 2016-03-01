<?php

namespace NielsHoppe\PHPCSS\Syntax\Rules;

use NielsHoppe\PHPCSS\Syntax\Rules\AtRule;

/**
 * @see https://www.w3.org/TR/css-syntax-3/#at-rule
 */

class ImportRule extends AtRule {

    private $media;

    /**
     * Construct an ImportRule from a URL and optionally media types
     *
     * @param string            $url
     * @param string|string[]   $media
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
