<?php

namespace Formjack\Layout;

use Formjack\Field\AbstractField;

abstract class AbstractLayout {

    /**
     * @param AbstractField $field
     */
    abstract public function renderField(AbstractField $field);

}