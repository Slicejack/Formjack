<?php

namespace Formjack\Rule;

use Formjack\Field\AbstractField;
use Formjack\Field\CheckboxField;

class Checked extends AbstractRule {

    /**
     * @param  AbstractField $field
     * @return bool
     */
    public function isValid(AbstractField $field) {
        if ($field instanceof CheckboxField) {
            return $field->getValue();
        }

        return false;
    }

}
