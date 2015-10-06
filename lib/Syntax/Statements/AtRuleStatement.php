<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

/**
 * @property string $keyword
 * @property string|Block $content
 */

class AtRuleStatement extends Statement {

    protected $keyword;
    protected $content;

    public function __construct ($keyword, $content) {

        $this->keyword = $keyword;
        $this->content = $content;
    }

    public function __toString () {

        if (is_string($this->content)) {

            $content = $this->content;
        }
        else {

            $content = $this->content->__toString();
        }

        $result = '@' . $this->keyword . ' ' . $content;

        return $result;
    }
}
