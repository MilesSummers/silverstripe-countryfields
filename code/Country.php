<?php

class Country extends DataObject
{
    private static $db = array(
		'Title' => 'Varchar(255)',
		'Code' => 'Varchar(10)'
    );

    private static $has_many = array(
		'Regions' => 'Region'
    );
    
	static function get_by_isocode($code) {
		if(!$code) return null;
		return DataObject::get_one("Country","\"Code\" = '$code'");
	}    
}
