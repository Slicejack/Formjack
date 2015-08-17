<?php

namespace Formjack\Field;

class CheckboxField extends AbstractField {

    /**
     * {@inheritdoc}
     */
    public function setValue($value) {
        return parent::setValue((bool)$value);
    }

    /**
     * @return void
     */
    public function init() {
        $this->setValue((bool)$this->getOption('value', false));
    }

    /**
     * @param  string|null $value
     * @return $this
     */
    public function bind($value) {
        return $this->setValue($value == 1);
    }

    /**
     * @param  array $attributes
     * @return string
     */
    public function render(array $attributes = array()) {
        return "<input type=\"checkbox\" name=\"{$this->getName()}\" value=\"1\" {$this->getAttributes($attributes)} {$this->checked()} />";
    }

    /**
     * @return string
     */
    private function checked() {
        return $this->getValue()? 'checked' : '' ;
    }

}