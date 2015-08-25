<?php

namespace Formjack;

use Formjack\Field\AbstractField;
use Formjack\Layout\AbstractLayout;
use Formjack\Layout\DefaultLayout;

class Form {

    /**
     * @var string Form name
     */
    private $name;

    /**
     * @var AbstractField[] Array of form fields
     */
    private $fields;

    /**
     * @var AbstractLayout Layout instance
     */
    private $layout;

    /**
     * @var array Array of validation errors
     */
    private $errors;

    /**
     * @param array Array of form fields
     */
    public function __construct($name, array $fields = array()) {
        $this
            ->setName($name)
            ->setFields($fields)
            ->setLayout(new DefaultLayout())
        ;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = str_replace(' ', '_', $name);

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields) {
        foreach ($fields as $field) {
            $this->addField($field);
        }

        return $this;
    }

    /**
     * @param  AbstractField $field
     * @return $this
     */
    public function addField(AbstractField $field) {
        $field->setParent($this);
        $this->fields[$field->getId()] = $field;

        return $this;
    }

    /**
     * @param  string $name
     * @return $this
     */
    public function removeField($name) {
        if (isset($this->fields[$name])) {
            unset($this->fields[$name]);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @param  AbstractLayout $layout
     * @return $this
     */
    public function setLayout(AbstractLayout $layout) {
        $this->layout = $layout;

        return $this;
    }

    /**
     * @param  array $data
     * @return $this
     */
    public function bind(array $data = array()) {
        foreach ($this->fields as $field) {
            if (isset($data[$field->getId()])) {
                $field->bind($data[$field->getId()]);
            } else {
                $field->bind(null);
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid() {
        foreach ($this->fields as $field) {
            $result = Validator::validateField($field);
            if (!$result->valid) {
                $this->errors[$field->getId()] = $result->trace;
            }
        }

        return empty($this->errors);
    }

    /**
     * @return bool
     */
    public function hasErrors() {
        return !empty($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getData() {
        $result = array();
        foreach ($this->fields as $field) {
            $result[$field->getId()] = $field->getValue();
        }

        return $result;
    }

    /**
     * @return void
     */
    public function render() {
        foreach ($this->fields as $name => $instance) {
            $this->renderField($name);
        }
    }

    /**
     * @return void
     */
    public function renderField($name) {
        if (isset($this->fields[$name])) {
            echo $this->layout->renderField($this->fields[$name]);
        }
    }

}
