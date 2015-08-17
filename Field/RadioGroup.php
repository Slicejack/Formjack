<?php

namespace Formjack\Field;

class RadioGroup extends AbstractGroup {

    /**
     * @return void
     */
    public function init() {
        parent::init();
        $this->value = $this->getOption('value', null);
    }

    /**
     * @param  string|null $choice
     * @return $this
     */
    public function bind($choice) {
        return ($this->isValidChoice($choice))? $this->setValue($choice) : $this->setValue(null) ;
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function renderChoice($choice, array $attributes = array()) {
        return "<input type=\"radio\" name=\"{$this->getName()}\" value=\"{$choice}\" {$this->getAttributes($attributes)} {$this->checked($choice)}/>";
    }

    /**
     * @param  string $choice
     * @return string
     */
    private function checked($choice) {
        return ($choice == $this->getValue())? 'checked' : '' ;
    }

}