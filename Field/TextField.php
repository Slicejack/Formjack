<?php

namespace Formjack\Field;

class TextField extends AbstractField {

    /**
     * @return $this
     */
    public function init() {
        return $this->setValue($this->getOption('value', ''));
    }

    /**
     * @param  string $value
     * @return $this
     */
    public function bind($value) {
        return $this->setValue($value);
    }

    /**
     * @param  array $attributes
     * @return string
     */
    public function render(array $attributes = array()) {
        return "<input type=\"text\" name=\"{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttributes($attributes)} />";
    }

}