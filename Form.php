<?php

namespace Formjack;

use Formjack\Field\AbstractField;

class Form {

    /**
     * @var array Array of form fields
     */
    private $fields;

    /**
     * @var array Array of validation errors
     */
    private $errors;

    /**
     * @param array Array of form fields
     */
    public function __construct(array $fields = array()) {
        foreach ($fields as $field) {
            if ($field instanceof AbstractField) {
                $this->addField($field);
            }
        }
    }

    /**
     * @return array
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields) {
        foreach ($fields as $field) {
            if ($field instanceof AbstractField) {
                $this->addField($field);
            }
        }
    }

    /**
     * @param  AbstractField $field
     * @return $this
     */
    public function addField(AbstractField $field) {
        $field->setParent($this);
        $this->fields[$field->getName()] = $field;

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
     * @return void
     */
    public function renderField($name) {
        if (isset($this->fields[$name])) {
            $field = $this->fields[$name]->render();
        } else {
            echo "Field with name <strong>'{$name}'</strong> does not exist.";
        }
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
    public function getFieldValues() {
        $result = array();
        foreach ($this->fields as $field) {
            $result[$field->getName()] = $field->getValue();
        }

        return $result;
    }

    /**
     * @param  array $request $_GET, $_POST etc.
     * @return $this
     */
    public function bind(array $request = array()) {
        foreach ($this->fields as $field) {
            if (isset($request[$field->getName()])) {
                $field->bind($request[$field->getName()]);
            } else {
                $field->bind('');
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
                $this->errors[$field->getName()] = $result->trace;
            }
        }

        return empty($this->errors);
    }

}