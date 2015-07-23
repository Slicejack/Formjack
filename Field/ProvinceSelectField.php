<?php

namespace Formjack\Field;

class ProvinceSelectField extends SelectField {

    /**
     * @return void
     */
    public function init() {
        parent::init();
        $this->choices = $this->getProvincesArray();
    }

    /**
     * @return array
     */
    private function getProvincesArray() {
        return array(
            'BC' => 'British Columbia', 
            'ON' => 'Ontario', 
            'NL' => 'Newfoundland and Labrador', 
            'NS' => 'Nova Scotia', 
            'PE' => 'Prince Edward Island', 
            'NB' => 'New Brunswick', 
            'QC' => 'Quebec', 
            'MB' => 'Manitoba', 
            'SK' => 'Saskatchewan', 
            'AB' => 'Alberta', 
            'NT' => 'Northwest Territories', 
            'NU' => 'Nunavut',
            'YT' => 'Yukon Territory'
        );
    }

}
