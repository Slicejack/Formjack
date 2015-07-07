<?php

namespace Formjack\Rule;

use Formjack\Field\AbstractField;

class CompanyVAT extends AbstractRule {

    /**
     * @var string Austria
     */
	const COUNTRY_AT = 'AT';

    /**
     * @var string Belgium
     */
	const COUNTRY_BE = 'BE';

    /**
     * @var string Bulgaria
     */
	const COUNTRY_BG = 'BG';

    /**
     * @var string Cyprus
     */
	const COUNTRY_CY = 'CY';

    /**
     * @var string Czech Republic
     */
	const COUNTRY_CZ = 'CZ';

    /**
     * @var string Germany
     */
	const COUNTRY_DE = 'DE';

    /**
     * @var string Denmark
     */
	const COUNTRY_DK = 'DK';

    /**
     * @var string Estonia
     */
	const COUNTRY_EE = 'EE';

    /**
     * @var string Greece
     */
	const COUNTRY_EL = 'EL';

    /**
     * @var string Spain
     */
	const COUNTRY_ES = 'ES';

    /**
     * @var string Finland
     */
	const COUNTRY_FI = 'FI';

    /**
     * @var string France
     */
	const COUNTRY_FR = 'FR';

    /**
     * @var string United Kingdom
     */
	const COUNTRY_GB = 'GB';

    /**
     * @var string Croatia
     */
	const COUNTRY_HR = 'HR';

    /**
     * @var string Hungary
     */
	const COUNTRY_HU = 'HU';

    /**
     * @var string Ireland
     */
	const COUNTRY_IE = 'IE';

    /**
     * @var string Italy
     */
	const COUNTRY_IT = 'IT';

    /**
     * @var string Lithuania
     */
	const COUNTRY_LT = 'LT';

    /**
     * @var string Luxembourg
     */
	const COUNTRY_LU = 'LU';

    /**
     * @var string Latvia
     */
	const COUNTRY_LV = 'LV';

    /**
     * @var string Malta
     */
	const COUNTRY_MT = 'MT';

    /**
     * @var string The Netherlands
     */
	const COUNTRY_NL = 'NL';

    /**
     * @var string Poland
     */
	const COUNTRY_PL = 'PL';

    /**
     * @var string Portugal
     */
	const COUNTRY_PT = 'PT';

    /**
     * @var string Romania
     */
	const COUNTRY_RO = 'RO';

    /**
     * @var string Sweden
     */
	const COUNTRY_SE = 'SE';

    /**
     * @var string Slovenia
     */
	const COUNTRY_SI = 'SI';

    /**
     * @var string Slovakia
     */
	const COUNTRY_SK = 'SK';

    /**
     * @var string WSDL URL
     */
    protected $wsdl;

    /**
     * @var string Country code
     */
    protected $countryCode;

    /**
     * @var \SoapClient Soap client instance
     */
    protected $client;

    /**
     * @param  string $countryCode
     * @param  string $invalidMessage
     * @param  bool   $negate
     * @throws \Exception
     */
    public function __construct($countryCode, $invalidMessage = '', $negate = false) {
        $this->countryCode = $countryCode;
        $this->wsdl = "http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl";
        if(!class_exists('SoapClient')) {
            throw new \Exception('Soap library not found. Please install and enable the library.');
        } else {
            try {
                $this->client = new \SoapClient($this->wsdl, array(
                    'trace' => true
                ));
            } catch(\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        parent::__construct($invalidMessage, $negate);
    }

	/**
     * @param  AbstractField $field
     * @return bool
     */
    public function isValid(AbstractField $field) {
        $result = $this->client->checkVat(array(
            'countryCode' => (string)$this->countryCode,
            'vatNumber' => (int)$field->getValue()
        ) );

        return $result->valid;
    }

}
