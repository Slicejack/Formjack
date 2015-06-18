<?php

namespace Formjack\Rule;

use Formjack\Field\AbstractField;

class Email extends AbstractRule {

    /**
     * @param  AbstractField $field
     * @return bool
     */
    public function isValid(AbstractField $field) {
        return filter_var($field->getValue(), FILTER_VALIDATE_EMAIL);
    }

}
