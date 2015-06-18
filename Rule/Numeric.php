<?php

namespace Formjack\Rule;

use Formjack\Field\AbstractField;

class Numeric extends AbstractRule {

    /**
     * @param  AbstractField $field
     * @return bool
     */
    public function isValid(AbstractField $field) {
        return is_numeric($field->getValue());
    }

}
