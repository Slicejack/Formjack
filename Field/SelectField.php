<?php

namespace Formjack\Field;

class SelectField extends AbstractField {

    /**
     * @var array Array of choices
     */
    private $choices;

    /**
     * @var bool Enable or disable multiselect option
     */
    private $multiselect;

    /**
     * {@inheritdoc}
     */
    public function setValue($value) {
        if ($this->multiselect && !is_array($value)) {
            return parent::setValue(array($value));
        } else {
            return parent::setValue($value);
        }
    }

    /**
     * @return void
     */
    public function init() {
        $this->choices = $this->getOption('choices', array());
        $this->multiselect = (bool)$this->getOption('multiselect', false);
        $this->setValue($this->getOption('value', array()));
    }

    /**
     * @param  string|array $value
     * @return $this
     */
    public function bind($value) {
        if ($this->multiselect && is_array($value) && !empty($value)) {
            foreach ($value as $single) {
                if (!$this->exists($single)) {
                    return $this;
                }
                return $this->setValue($value);
            }
        } else {
            if (!is_array($value) && $this->exists($value)) {
                return $this->setValue($value);
            }
            return $this;
        }
    }

    /**
     * @return void
     */
    public function render() {
        $multiple = ($this->multiselect)? 'multiple' : '';
        $name = ($this->multiselect)? $this->getName() . '[]' : $this->getName();
        echo "<select name=\"{$name}\" {$this->getAttributes()} {$multiple}>";
        foreach ($this->choices as $val => $choice) {
            $selected = ($this->selected($val))? 'selected' : '';
            echo "<option value=\"{$val}\" {$selected}>{$choice}</option>";
        }
        echo "</select>";
    }

    /**
     * @param  string $choice
     * @return bool
     */
    private function selected($choice) {
        if (is_array($this->getValue())) {
            return in_array($choice, $this->getValue());
        } else {
            return ($choice == $this->getValue());
        }
    }

    /**
     * @param  string $choice
     * @return bool
     */
    private function exists($choice) {
        return array_key_exists($choice, $this->choices);
    }

}
