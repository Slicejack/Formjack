<?php

namespace Formjack\Field;

class PasswordField extends TextField {

    /**
     * {@inheritdoc}
     */
    public function render() {
        echo "<input type=\"password\" name=\"{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttributes()} />";
    }

}
