<?php

namespace Formjack\Field;

abstract class AbstractGroup extends AbstractField {

    /**
     * @var array
     */
    protected $choices;

    /**
     * @return void
     */
    public function init() {
        $this->choices = $this->getOption('choices', array());
    }

    /**
     * @param  array $attributes
     * @return string
     */
    public function render(array $attributes = array()) {
        return '';
    }

    /**
     * @return array
     */
    public function getChoices() {
        return $this->choices;
    }

    /**
     * @param  string $choice
     * @return bool
     */
    protected function isValidChoice($choice) {
        return array_key_exists($choice, $this->choices);
    }

    /**
     * @param string $choice
     * @param array  $attributes
     */
    abstract public function renderChoice($choice, array $attributes = array());

}