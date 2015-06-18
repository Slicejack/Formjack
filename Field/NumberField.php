<?php

namespace Formjack\Field;

class NumberField extends TextField {

    /**
     * {@inheritdoc}
     */
    public function render() {
        echo "<input type=\"number\" name=\"{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttributes()} />";
    }

}
