<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| Widget settings
	|--------------------------------------------------------------------------
	|
	| List the widgets in order they will appear.
	|
	| The widget settings must have a unique key as this is used to retrieve the settings in the controller.
	|
	*/

	'weather' => array(
		'widget'   => 'weather',
		'class'    => 'small',
		'zip'      => 28056,
		'interval' => 3600,
	),
	'githubissues_laravel' => array(
		'widget'   => 'githubissues',
		'class'    => 'small',
		'user'     => 'laravel',
		'project'  => 'laravel',
		'label'    => 'open'
	),
	'githubcommits_laravel' => array(
		'widget'   => 'githubcommits',
		'class'    => 'small',
		'user'     => 'laravel',
		'project'  => 'laravel',
		'branch'   => 'skunkworks'
	),
	'twitter_laravel' => array(
		'widget'   => 'twitter',
		'class'    => 'small',
		'search'   => 'laravel',
		'interval' => 300,
	),
	'twitter_helpspot' => array(
		'widget'   => 'twitter',
		'class'    => 'small',
		'search'   => 'helpspot',
	),
	'twitter_ericlbarnes' => array(
		'widget'   => 'twitter',
		'class'    => 'small',
		'search'   => 'ericlbarnes',
	),
	'stocks' => array(
		'widget'   => 'stocks',
		'class'    => 'small',
		'exchange' => 'NASDAQ',
		'symbol'   => 'GOOG',
	)
);
