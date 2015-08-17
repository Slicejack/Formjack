<?php

namespace Formjack\Field;

class PasswordField extends TextField {

    /**
     * {@inheritdoc}
     */
    public function render(array $attributes = array()) {
        return "<input type=\"password\" name=\"{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttributes($attributes)} />";
    }

}