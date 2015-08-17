<?php

namespace Formjack\Field;

class TextareaField extends TextField {

    /**
     * {@inheritdoc}
     */
    public function render(array $attributes = array()) {
        return "<textarea name=\"{$this->getName()}\" {$this->getAttributes($attributes)}>{$this->getValue()}</textarea>";
    }

}