<?php

namespace NielsHoppe\PHPCSS\Statements;

use NielsHoppe\PHPCSS\Statements\AtRuleStatement as AtRuleStatement;

class ImportStatement extends AtRuleStatement {

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
