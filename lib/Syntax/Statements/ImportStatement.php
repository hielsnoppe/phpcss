<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

use NielsHoppe\PHPCSS\Syntax\Statements\AtRuleStatement;

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
