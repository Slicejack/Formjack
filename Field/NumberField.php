<?php

namespace Formjack\Field;

class NumberField extends TextField {

    /**
     * {@inheritdoc}
     */
    public function render(array $attributes = array()) {
        return "<input type=\"number\" name=\"{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttributes($attributes)} />";
    }

}