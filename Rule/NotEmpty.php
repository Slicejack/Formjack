<?php

namespace Formjack\Rule;

use Formjack\Field\AbstractField;

class NotEmpty extends AbstractRule {

    /**
     * @param  AbstractField $field
     * @return bool
     */
    public function isValid(AbstractField $field) {
        $value = $field->getValue();

        if (is_string($value)) {
            $value = trim($value);
        }

        return !empty($value);
    }

}
