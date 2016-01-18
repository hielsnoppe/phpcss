<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

/**
 * @see https://www.w3.org/TR/CSS21/syndata.html#at-rules
 */

class AtRuleStatement extends Statement {

    /**
     * @var string          $keyword
     * @var string|Block    $content
     */

    protected $keyword;
    protected $content;

    /**
     * @param string    $keyword
     * @param string    $content
     */

    public function __construct ($keyword, $content) {

        $this->keyword = $keyword;
        $this->content = $content;
    }

    /**
     * Return string representation
     *
     * @return string
     */

    public function __toString () {

        if (is_string($this->content)) {

            $content = $this->content;
        }
        else {

            $content = $this->content->__toString();
        }

        $result = sprintf('@%s %s', $this->keyword, $content);

        return $result;
    }
}
