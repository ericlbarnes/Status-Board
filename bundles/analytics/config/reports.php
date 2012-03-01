<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| Analytics Widget Report settings
	|--------------------------------------------------------------------------
	|
	| List the widgets in order they will appear.
	|
	| The widget settings must have a unique key as this is used to retrieve the settings in the controller.
	|
	*/
	'top_content' => array(
		'name'    => 'Top Content (last hour)',
		'start'   => '1 hour',
		'properties' => array(
			'dimensions' => 'ga:pagePath',
			'metrics' => 'ga:pageviews,ga:uniquePageviews,ga:avgTimeOnPage,ga:pageviewsPerVisit',
			'sort' => '-ga:pageviews',
		),
	),
	'top_sections' => array(
		'name'    => 'Top Sections (today)',
		'start'   => '1 day',
		'properties' => array(
			'dimensions' => 'ga:pagePath',
			'metrics' => 'ga:pageviews,ga:uniquePageviews,ga:avgTimeOnPage,ga:pageviewsPerVisit',
			'sort' => '-ga:pageviews',
		),
	),

	'search' => array(
		'name'    => 'Search Keywords (today)',
		'start'   => '0 day',
		'properties' => array(
			'dimensions' => 'ga:keyword',
			'metrics' => 'ga:visits,ga:pageviews,ga:pageviewsPerVisit,ga:avgTimeOnSite',
			'sort' => '-ga:visits',
		),
	),

	'visitors' => array(
		'name'    => 'Visitors (last 7 days)',
		'start'   => '1 week',
		'properties' => array(
			'dimensions' => 'ga:date',
			'metrics' => 'ga:pageviews,ga:visits,ga:bounces',
			'sort' => 'ga:date'
		),
	),
);
