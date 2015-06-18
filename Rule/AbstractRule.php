<?php

namespace Formjack\Rule;

use Formjack\Field\AbstractField;

abstract class AbstractRule {

    /**
     * @var string Invalid value message
     */
    protected $invalidMessage;

    /**
     * @var bool Determines if the rule should be negated
     */
    protected $negate;

    /**
     * @var array Array of subrules
     */
    protected $children = null;

    /**
     * @param string $invalidMessage
     * @param bool   $negate
     */
    public function __construct($invalidMessage = '', $negate = false) {
        $this->invalidMessage = $invalidMessage;
        $this->negate = $negate;
    }

    /**
     * @param  AbstractField $field
     * @return bool
     */
    public function run(AbstractField $field) {
        return true;
    }

    /**
     * @param  string $invalidMessage
     * @return $this
     */
    public function setInvalidMessage($invalidMessage) {
        $this->invalidMessage = $invalidMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvalidMessage() {
        return $this->invalidMessage;
    }

    /**
     * @param  AbstractField $field
     * @return bool
     */
    public function validate(AbstractField $f) {
        return ($this->negate)? !$this->isValid($f) : $this->isValid($f);
    }

    /**
     * @param AbstractField $field
     */
    abstract public function isValid(AbstractField $field);

}
