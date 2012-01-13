<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Status Board settings
	|--------------------------------------------------------------------------
	|
	| The possible boards available.
	|
	*/

	'default' => array(
		'name'    => 'Top Dashboard',
		'theme'   => 'wood',
		'widgets' => array(
			'weather',
			'githubissues_laravel',
			'githubcommits_laravel',
			'twitter_laravel',
			'twitter_helpspot',
			'twitter_ericlbarnes',
			'stocks',
			'rss',
		),
	),

	'number2' => array(
		'name'    => 'Dashboard Number 2',
		'widgets' => array(
			'githubissues_statusb',
			'githubcommits_statusb',
			'twitter_ericlbarnes',
		),
	),

);
