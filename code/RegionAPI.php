<?php

class RegionAPI extends Controller {

	private static $allowed_actions = array(
		"getregions" => true
	);

	function getregions(SS_HTTPRequest $request) {
		$country = $request->postVar('Country');
		if(!$country) {
			return $this->error('Country not provided');
		}
		$regions = Region::get_by_country($country);
		if(!$regions) {
			return $this->error('There are no regions for that country');
		}
		return json_encode(array(
			'success' => true,
			'regions' => $regions->toNestedArray()
		));
	}

	function error($message, $code = null) {
		return json_encode(array_filter(array(
			'success' => false,
			'message' => $message,
			'code' => $code
		)));
	}

}
