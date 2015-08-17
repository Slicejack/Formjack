<?php

namespace Formjack\Field;

class SelectField extends AbstractField {

    /**
     * @var array Array of choices
     */
    protected $choices;

    /**
     * @var bool Enable or disable multiselect option
     */
    protected $multiselect;

    /**
     * @var string
     */
    protected $emptyValue;

    /**
     * {@inheritdoc}
     */
    public function setValue($value) {
        if ($this->multiselect) {
            $value = (is_array($value))? $value : array($value);
            return parent::setValue($value);
        }
        return parent::setValue($value);
    }

    /**
     * @return void
     */
    public function init() {
        $this->choices = $this->getOption('choices', array());
        $this->multiselect = (bool)$this->getOption('multiselect', false);
        if ($this->multiselect) {
            $this->emptyValue = null;
            $this->setValue($this->getOption('value', array()));
        } else {
            $this->emptyValue = $this->getOption('empty_value', null);
            if ($this->emptyValue) {
                $this->setValue($this->getOption('value', ''));
            } else {
                $this->setValue($this->getOption('value', null));
            }
        }
    }

    /**
     * @param  string|array|null $value
     * @return $this
     */
    public function bind($value) {
        if ($this->multiselect) {
            if ($value) {
                $valid = array();
                $value = (is_array($value))? $value : array($value);
                foreach ($value as $single) {
                    if ($this->exists($single)) {
                        $valid[] = $single;
                    }
                }
                return $this->setValue($valid);
            }
            return $this->setValue(array());
        } else {
            if (!is_array($value) && $this->exists($value)) {
                return $this->setValue($value);
            }
            return $this->setValue(null);
        }
    }

    /**
     * @param  array $attributes
     * @return string
     */
    public function render(array $attributes = array()) {
        $html = "";
        $multiple = ($this->multiselect)? 'multiple' : '';
        $name = ($this->multiselect)? $this->getName() . '[]' : $this->getName();
        $html .= "<select name=\"{$name}\" {$this->getAttributes($attributes)} {$multiple}>";
        if ($this->emptyValue) {
            $html .= "<option value=\"\">{$this->emptyValue}</option>";
        }
        foreach ($this->choices as $value => $text) {
            $selected = ($this->selected($value))? 'selected' : '';
            $html .= "<option value=\"{$value}\" {$selected}>{$text}</option>";
        }
        $html .= "</select>";

        return $html;
    }

    /**
     * @param  string $choice
     * @return bool
     */
    private function selected($choice) {
        if (is_array($this->getValue())) {
            return in_array($choice, $this->getValue());
        }
        return ($choice == $this->getValue());
    }

    /**
     * @param  string $choice
     * @return bool
     */
    private function exists($choice) {
        if ($choice == '' && $this->emptyValue !== null) {
            return true;
        }
        return array_key_exists($choice, $this->choices);
    }

}