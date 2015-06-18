<?php

namespace Formjack\Field;

class EmailField extends TextField {

    /**
     * {@inheritdoc}
     */
    public function render() {
        echo "<input type=\"email\" name=\"{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttributes()} />";
    }

}
