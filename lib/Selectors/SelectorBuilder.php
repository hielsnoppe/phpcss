<?php

namespace NielsHoppe\PHPCSS\Selectors;

class SelectorBuilder {

    protected $chain;
    protected $attributeOpen;
    protected $openAttribute;

    public function __construct ($type = '*') {

        $this->attributeOpen = false;
        $this->openAttribute = null;
        $this->chain = array();

        $this->addTypeOrUniversal($type);

        return $this;
    }

    public function descendants ($type = '*') {

        $this->closeOpenAttribute();
        $this->addSelectorOrCombinator(Selector::DESCENDANT_COMBINATOR);
        $this->addTypeOrUniversal($type);

        return $this;
    }

    public function children ($type = '*') {

        $this->closeOpenAttribute();
        $this->addSelectorOrCombinator(Selector::CHILD_COMBINATOR);
        $this->addTypeOrUniversal($type);

        return $this;
    }

    public function siblings ($type = '*') {

        $this->closeOpenAttribute();
        $this->addSelectorOrCombinator(Selector::GENERAL_SIBLING_COMBINATOR);
        $this->addTypeOrUniversal($type);

        return $this;
    }

    public function adjacentSiblings ($type = '*') {

        $this->closeOpenAttribute();
        $this->addSelectorOrCombinator(Selector::ADJACENT_SIBLING_COMBINATOR);
        $this->addTypeOrUniversal($type);

        return $this;
    }

    public function id ($id) {

        $this->closeOpenAttribute();
        $this->addSelectorOrCombinator(new IDSelector($id));

        return $this;
    }

    public function hasClass ($class) {

        $this->closeOpenAttribute();
        $this->addSelectorOrCombinator(new ClassSelector($class));

        return $this;
    }

    public function attr ($attribute) {

        $this->closeOpenAttribute();

        $this->attributeOpen = true;
        $this->openAttribute = $attribute;

        return $this;
    }

    public function eq ($value) {

        if (isset($this->openAttribute)) {

            $this->addSelectorOrCombinator(new AttributeSelector($this->openAttribute, $value, AttributeSelector::MATCH_EXACT));

            $this->attributeOpen = false;

            return $this;
        }

        throw new \Exception('Missing attribute for exact match');
    }

    public function prefix ($value) {

        if (isset($this->openAttribute)) {

            $this->addSelectorOrCombinator(new AttributeSelector($this->openAttribute, $value, AttributeSelector::MATCH_PREFIX));

            $this->attributeOpen = false;

            return $this;
        }

        throw new \Exception('Missing attribute for prefix match');
    }

    public function suffix ($value) {

        if (isset($this->openAttribute)) {

            $this->addSelectorOrCombinator(new AttributeSelector($this->openAttribute, $value, AttributeSelector::MATCH_SUFFIX));

            $this->attributeOpen = false;

            return $this;
        }

        throw new \Exception('Missing attribute for suffix match');
    }

    public function contains ($value) {

        if (isset($this->openAttribute)) {

            $this->addSelectorOrCombinator(new AttributeSelector($this->openAttribute, $value, AttributeSelector::MATCH_INCLUDES));

            $this->attributeOpen = false;

            return $this;
        }

        throw new \Exception('Missing attribute for includes match');
    }

    public function substr ($value) {

        if (isset($this->openAttribute)) {

            $this->addSelectorOrCombinator(new AttributeSelector($this->openAttribute, $value, AttributeSelector::MATCH_SUBSTRING));

            $this->attributeOpen = false;

            return $this;
        }

        throw new \Exception('Missing attribute for substring match');
    }

    public function dash ($value) {

        if (isset($this->openAttribute)) {

            $this->addSelectorOrCombinator(new AttributeSelector($this->openAttribute, $value, AttributeSelector::MATCH_DASH));

            $this->attributeOpen = false;

            return $this;
        }

        throw new \Exception('Missing attribute for dash match');
    }

    public function getSelector () {

        if ($this->attributeOpen) {

            $this->addSelectorOrCombinator(new AttributeSelector($this->openAttribute));
        }

        return new Selector($this->chain);
    }

    /**
     * Protected methods for internal use
     */

    protected function addSelectorOrCombinator ($item) {

        array_push($this->chain, $item);
    }

    protected function addTypeOrUniversal ($type = '*') {

        $this->addSelectorOrCombinator(
            $type == '*' ?
            new UniversalSelector() :
            new TypeSelector($type)
        );
    }

    protected function closeOpenAttribute () {

        if ($this->attributeOpen) {

            $this->addSelectorOrCombinator(new AttributeSelector($this->openAttribute));

            $this->attributeOpen = false;
            $this->openAttribute = null;
        }
    }
}
