<?php

namespace Formjack\Rule;

use Formjack\Field\AbstractField;

class When extends AbstractRule {

    /**
     * @var callable Condition function
     */
    private $condition;

    public function __construct(callable $condition, array $children = array()) {
        $this->condition = $condition;
        $this->children = $children;
    }

    /**
     * {@inheritdoc}
     */
    public function run(AbstractField $field) {
        return call_user_func_array($this->condition, array(
            $field->getParent()->getFieldValues()
        ));
    }

    /**
     * @param  AbstractField $field
     * @return array
     */
    public function isValid(AbstractField $field) {
        return $this->children;
    }

}
