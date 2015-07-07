<?php

namespace Formjack\Rule;

use Formjack\Field\AbstractField;

class Length extends AbstractRule {

    /**
     * @var int Min length
     */
    protected $min;

    /**
     * @var int Max length
     */
    protected $max;

    /**
     * @var bool Min and max are included
     */
    protected $inclusive;


    public function __construct($min = null, $max = null, $inclusive = true, $invalidMessage = '', $negate = false) {
        $this->min = $min;
        $this->max = $max;
        $this->inclusive = (bool)$inclusive;
        parent::__construct($invalidMessage, $negate);
    }

    /**
     * @param  AbstractField $field
     * @return bool
     */
    public function isValid(AbstractField $field) {
        $value = $field->getValue();

        if ($this->min !== null) {
            if (
                ($this->inclusive == true && !(strlen($value) >= $this->min)) ||
                ($this->inclusive == false && !(strlen($value) > $this->min))
            ) {
                return false;
            }
        }

        if ($this->max !== null) {
            if (
                ($this->inclusive == true && !(strlen($value) <= $this->max)) ||
                ($this->inclusive == false && !(strlen($value) < $this->max))
            ) {
                return false;
            }
        }

        return true;
    }

}
