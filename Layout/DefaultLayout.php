<?php

namespace Formjack\Layout;

use Formjack\Field\AbstractField;

class DefaultLayout extends AbstractLayout {

    /**
     * @param  AbstractField $field
     * @return string
     */
    public function renderField(AbstractField $field) {
        $html = "<div>";
        if ($field instanceof \Formjack\Field\CheckboxField) {
            if ($field->hasLabel()) {
                $html .= "<label>{$field->render()}&nbsp;{$field->getLabel()}</label>";
            } else {
                $html .= $field->render();
            }
        } elseif ($field instanceof \Formjack\Field\AbstractGroup) {
            if ($field->hasLabel()) {
                $html .= "<label>{$field->getLabel()}</label>";
            }
            foreach ($field->getChoices() as $choice => $label) {
                $html .= "<label>{$field->renderChoice($choice)}&nbsp;{$label}</label>";
            }
        } else {
            if ($field->hasLabel()) {
                $html .= "<label>{$field->getLabel()}</label>";
            }
            $html .= $field->render();
        }
        $html .= "</div>";

        return $html;
    }

}