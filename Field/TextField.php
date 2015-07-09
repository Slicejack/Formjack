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
     * @return void
     */
    public function render() {
        echo "<input type=\"text\" name=\"{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttributes()} />";
    }

}
