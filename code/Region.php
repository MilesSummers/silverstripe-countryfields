<?php

class Region extends DataObject
{
    private static $db = array(
		'Title' => 'Varchar(255)'
    );

    private static $has_one = array(
		'Country' => 'Country'
    );
    
	static function get_by_country($country) {
		$countryobj = null;
		if(is_string($country) && strlen($country) === 2) {
			$countryobj = DataObject::get_one('Country',"\"Code\"  = '$country'");
		} else {
			$countryobj = $country;
		}
		if(!($countryobj instanceof Country)) {
			return null;
		}
		return DataObject::get("Region","\"CountryID\" = ".$countryobj->ID)->sort('Title ASC');
	}    
}

