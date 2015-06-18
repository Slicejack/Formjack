<?php

namespace Formjack\Field;

use Formjack\Form;
use Formjack\Rule\AbstractRule;
use Formjack\Helper\ValidationCondition;

abstract class AbstractField {

    /**
     * @var string Form field name
     */
    protected $name;

    /**
     * @var array Field options
     */
    protected $options;

    /**
     * @var array Array of validation rules
     */
    protected $rules;

    /**
     * @var string Form field value
     */
    protected $value;

    /**
     * @var Form
     */
    protected $parent;

    /**
     * @param string $name
     * @param array  $options
     * @param array  $rules
     */
    public function __construct($name, array $options = array(), array $rules = array()) {
        $this->setName($name);
        $this->setOptions($options);
        $this->setRules($rules);
        $this->init();
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param  string $name
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @param  string $name
     * @param  mixed  $fallback
     * @return mixed
     */
    public function getOption($name, $fallback = null) {
        return (isset($this->options[$name]))? $this->options[$name] : $fallback ;
    }

    /**
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param  array $options
     * @return $this
     */
    public function setOptions(array $options) {
        $this->options = $options;

        return $this;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function addOption($name, $value) {
        $this->options[$name] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getRules() {
        return $this->rules;
    }

    /**
     * @param  array $rules
     * @return $this
     */
    public function setRules(array $rules) {
        $this->rules = array();
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }
    }

    /**
     * @param  AbstractRule|ValidationCondition $rule
     * @return $this
     */
    public function addRule(AbstractRule $rule) {
        $this->rules[] = $rule;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param  mixed $value
     * @return $this
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Form
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @param  Form $parent
     * @return $this
     */
    public function setParent(Form $parent) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return string
     */
    public function getAttributes(array $disallowed = array()) {
        $result = "";
        $attributes = $this->getOption('attributes', array());
        if (!empty($attributes)) {
            foreach ($attributes as $name => $value) {
                if (!in_array($name, $disallowed)) {
                    $result .= " {$name}=\"{$value}\"";
                }
            }
        }

        return $result;
    }

    abstract public function init();

    abstract public function bind($value);

    abstract public function render();

}
