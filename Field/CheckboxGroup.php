<?php

namespace Formjack\Field;

class CheckboxGroup extends AbstractGroup {
    
    /**
     * {@inheritdoc}
     */
    public function setValue($value) {
        $value = (is_array($value))? $value : array($value);
        return parent::setValue($value);
    }

    /**
     * @return void
     */
    public function init() {
        parent::init();
        $this->setValue($this->getOption('value', array()));
    }

    /**
     * @param  array|null $choices
     * @return $this
     */
    public function bind($choices) {
        $value = array();
        $choices = is_array($choices)? $choices : array() ;
        foreach ($choices as $choice => $label) {
            if ($this->isValidChoice($choice)) {
                $value[] = $choice;
            }
        }

        return $this->setValue($value);
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function renderChoice($choice, array $attributes = array()) {
        return "<input type=\"checkbox\" name=\"{$this->getName()}[{$choice}]\" value=\"1\" {$this->getAttributes($attributes)} {$this->checked($choice)} />";
    }

    /**
     * @param  string $choice
     * @return string
     */
    private function checked($choice) {
        return in_array($choice, $this->value)? 'checked' : '' ;
    }

}