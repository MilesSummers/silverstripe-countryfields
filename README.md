# CountryFields Module

Provides a CountryField that relaces a Region TextField with a dropdown list of regions for the selected Country.
Based heavily on the RegionalData module

This module is not intended to replace zend_locale.

## Installation
 * Unzip to your silverstripe root / countryfields.
 * Import the country and region data to your database
 
You should now be able to see countries and subdivisions in yoursite.tld/admin/regions

## Usage
 * Auto-completion country and state fields
```
$fields = new FieldList(
	$country = CountryField::Create('Country', 'Country', 'Region', 'AU')->setEmptyString('(Select one)')->setHasEmptyDefault(true),
	$region = TextField::Create('Region', 'Region')
);
```

## Provided Data Set

## Future TODO / Ideas
 * Create a BuildTask to load data
