<?php

namespace Formjack\Field;

class CheckboxField extends AbstractField {

    /**
     * @var string Switch value that makes checkbox true or false
     */
    private $switch;

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
        $this->switch = $this->getOption('switch', 1);
        $this->setValue((bool)$this->getOption('value', false));
    }

    /**
     * @return $this
     */
    public function bind($value) {
        return $this->setValue($value == $this->switch);
    }

    /**
     * @return void
     */
    public function render() {
        $checked = $this->getValue()? 'checked' : '' ;
        echo "<input type=\"checkbox\" name=\"{$this->getName()}\" value=\"{$this->switch}\" {$this->getAttributes()} {$checked} />";
    }

}
