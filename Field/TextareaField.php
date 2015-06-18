<?php

namespace Formjack\Field;

class TextareaField extends TextField {

    /**
     * {@inheritdoc}
     */
    public function render() {
        echo "<textarea name=\"{$this->getName()}\" {$this->getAttributes()}>{$this->getValue()}</textarea>";
    }

}
