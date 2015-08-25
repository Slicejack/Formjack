<?php

namespace Formjack;

use Formjack\Field\AbstractField;
use Formjack\Rule\AbstractRule;

class Validator {

    /**
     * @param  AbstractField $field
     * @return \stdClass
     */
    public static function validateField(AbstractField $field) {
        $errors = array();
        $result = new \stdClass();
        if ($field->hasRules()) {
            self::loop($field, $field->getRules(), $errors);
        }
        
        $result->valid = empty($errors);
        $result->trace = $errors;

        return $result;
    }

    /**
     * @param  AbstractField  $field
     * @param  AbstractRule[] $rules
     * @param  array          &$errors
     * @return void
     */
    private static function loop(AbstractField $field, array $rules, array &$errors) {
        foreach ($rules as $rule) {
            if ($rule->run($field)) {
                $result = $rule->validate($field);
                if (is_bool($result) && $result === false) {
                    $errors[] = $rule->getInvalidMessage();
                } elseif (is_array($result)) {
                    self::loop($field, $result, $errors);
                }
            }
        }

        return;
    }

}
