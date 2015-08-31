<?php

namespace Formjack\Field;

class HiddenField extends TextField {

    /**
     * {@inheritdoc}
     */
    public function render(array $attributes = array()) {
        return "<input type=\"hidden\" name=\"{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttributes($attributes)} />";
    }

}