<?php
class CountryField extends DropdownField {
	protected $region;

	/**
	 * @config  boolean Whether to Require jquery
     */
    private static $jquery = true;
    

	/**
	 * @config  boolean Whether to use bootstrap theme
     */
    private static $bootstrap = true;
    

	/**
	 * @param string $name The field name
	 * @param string $title The field title
	 * @param string | FormField $region The name or object of the RegionField
	 * @param string $value The current value
	 * @param Form $form The parent form
	 */
	public function __construct($name, $title=null, $region=null, $value='', $form=null, $emptyString=null) {
		$this->setRegion($region);
		
		if($emptyString === true) {
			Deprecation::notice('4.0',
				'Please use setHasEmptyDefault(true) instead of passing a boolean true $emptyString argument',
				Deprecation::SCOPE_GLOBAL);
		}
		if(is_string($emptyString)) {
			Deprecation::notice('4.0', 'Please use setEmptyString() instead of passing a string emptyString argument.',
				Deprecation::SCOPE_GLOBAL);
		}

		if($emptyString) $this->setHasEmptyDefault(true);
		if(is_string($emptyString)) $this->setEmptyString($emptyString);
		
		$source = Country::get()->sort('Title ASC')->map('Code', 'Title');
		
		parent::__construct($name, ($title===null) ? $name : $title, $source, $value, $form);
	}

	public function setRegion($region) {
		$this->region = $region;
		return $this;
	}
	
	
	public function getRegion() {
		return $this->region;
	}
	
	/**
	 * Get the region of this field as an name string
	 *
	 * @return array
	 */
	public function getRegionName() {
		$region = $this->getRegion();

		// Get region
		if($region instanceof FormField) {
			return $region->getName();
		} else {
			return $region;
		}
	}

	 public function Field($properties = array()) {
		if( $region = $this->getRegionName() ) {
			if($this->config()->jquery) Requirements::javascript(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');
			Requirements::javascript(COUNTRY_FIELDS_DIR.'/javascript/select2.full.js');
			Requirements::css(COUNTRY_FIELDS_DIR."/css/select2.min.css");
			if($this->config()->bootstrap) Requirements::css(COUNTRY_FIELDS_DIR."/css/select2-bootstrap.min.css");

			$vars = array(
				"CountryField" => $this->getName(),
				"RegionField" => $region
			);

			Requirements::javascriptTemplate(COUNTRY_FIELDS_DIR."/javascript/region.jquery.js", $vars);
			if($this->config()->bootstrap) Requirements::javascriptTemplate(COUNTRY_FIELDS_DIR."/javascript/enable.select2.bootstrap.js", $vars);
			else Requirements::javascriptTemplate(COUNTRY_FIELDS_DIR."/javascript/enable.select2.js", $vars);
		}
		return parent::Field($properties);
	}
	
}
