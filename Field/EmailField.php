<?php

namespace Formjack\Field;

class EmailField extends TextField {

    /**
     * {@inheritdoc}
     */
    public function render(array $attributes = array()) {
        return "<input type=\"email\" name=\"{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttributes($attributes)} />";
    }

}