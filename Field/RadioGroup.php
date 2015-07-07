<?php

namespace Formjack\Field;

class RadioGroup extends AbstractField {

    /**
     * @var array Array of choices
     */
    protected $choices;

    /**
     * @return void
     */
    public function init() {
        $this->choices = $this->getOption('choices', array());
        $this->value = $this->getOption('value', null);
    }

    /**
     * @param  string|array $value
     * @return $this
     */
    public function bind($value) {
        if ($this->exists($value)) {
            return $this->setValue($value);
        }

        return $this->setValue(null);
    }

    /**
     * @return void
     */
    public function render() {
        foreach ($this->choices as $value => $label) {
            $checked = ($this->checked($value))? 'checked' : '' ;
            echo "<div>";
            echo "<input type=\"radio\" id=\"option-{$value}\" name=\"{$this->getName()}\" value=\"{$value}\" {$this->getAttributes()} {$checked}/>";
            echo "<label for=\"option-{$value}\">{$label}</label>";
            echo "</div>";
        }
    }

    /**
     * @param  string $choice
     * @return bool
     */
    private function exists($choice) {
        return array_key_exists($choice, $this->choices);
    }

    /**
     * @param  string $choice
     * @return bool
     */
    private function checked($choice) {
        return ($choice == $this->getValue());
    }

}
