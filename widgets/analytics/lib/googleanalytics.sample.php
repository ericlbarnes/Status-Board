<?php
// include the Google Analytics PHP class
include "googleanalytics.class.php";
try {
	// create an instance of the GoogleAnalytics class using your own Google {email} and {password}
	$ga = new GoogleAnalytics('{email}','{password}');

	// set the Google Analytics profile you want to access - format is 'ga:123456';
	$ga->setProfile('{GA Profile ID}');

	// set the date range we want for the report - format is YYYY-MM-DD
	$ga->setDateRange('2009-04-01','2009-04-07');

	// get the report for date and country filtered by Australia, showing pageviews and visits
	$report = $ga->getReport(
		array('dimensions'=>urlencode('ga:date,ga:country'),
			'metrics'=>urlencode('ga:pageviews,ga:visits'),
			'filters'=>urlencode('ga:country=@Australia'),
			'sort'=>'-ga:pageviews'
			)
		);

	//print out the $report array
	print "<pre>";
	print_r($report);
	print "</pre>";
	
} catch (Exception $e) { 
	print 'Error: ' . $e->getMessage(); 
}

?>