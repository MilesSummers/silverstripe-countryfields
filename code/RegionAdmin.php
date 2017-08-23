<?php

class RegionAdmin extends ModelAdmin{

	private static $menu_icon = 'countryfields/images/cmsicon.png';

	static $url_segment = 'regions';
	static $menu_title = 'Regions';

	static $managed_models = array('Country');

}
