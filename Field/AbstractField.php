<?php

namespace Formjack\Field;

use Formjack\Form;
use Formjack\Rule\AbstractRule;

abstract class AbstractField {

    /**
     * @var string Field name
     */
    protected $name;

    /**
     * @var array Array of field options
     */
    protected $options;

    /**
     * @var AbstractRule[] Array of validation rules
     */
    protected $rules;

    /**
     * @var mixed Field value
     */
    protected $value;

    /**
     * @var Form
     */
    protected $parent;

    /**
     * @param  string          $name
     * @param  array           $options
     * @param  AbstractRule[]  $rules
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
     * @param  mixed  $default
     * @return mixed
     */
    public function getOption($name, $default = null) {
        return (isset($this->options[$name]))? $this->options[$name] : $default ;
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
     * @param  string $name
     * @param  mixed  $value
     * @return $this
     */
    public function addOption($name, $value) {
        $this->options[$name] = $value;

        return $this;
    }

    /**
     * @return AbstractRule[]
     */
    public function getRules() {
        return $this->rules;
    }

    /**
     * @param  AbstractRule[] $rules
     * @return $this
     */
    public function setRules(array $rules) {
        $this->rules = array();
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }
    }

    /**
     * @param  AbstractRule $rule
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
     * @return bool
     */
    public function hasLabel() {
        return ($this->getOption('label', null))? true : false ;
    }

    /**
     * @return string
     */
    public function getLabel() {
        return $this->getOption('label', '');
    }

    /**
     * @return bool
     */
    public function hasErrors() {
        if ($this->parent->hasErrors()) {
            return array_key_exists($this->name, $this->parent->getErrors());
        }

        return false;
    }

    /**
     * @return array
     */
    public function getErrors() {
        $errors = $this->parent->getErrors();
        return isset($errors[$this->name])? $errors[$this->name] : array();
    }

    /**
     * @param  array $merge
     * @return string
     */
    public function getAttributes(array $merge = array()) {
        $result = "";
        $attributes = $this->getOption('attributes', array());
        if (!empty($merge)) {
            $attributes = array_merge_recursive($attributes, $merge);
        }
        if (!empty($attributes)) {
            foreach ($attributes as $name => $value) {
                if (is_array($value)) {
                    $value = implode(' ', $value);
                }
                $result .= " {$name}=\"{$value}\"";
            }
        }

        return $result;
    }

    abstract public function init();

    abstract public function bind($value);

    abstract public function render(array $attributes = array());

}