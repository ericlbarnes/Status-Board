<!doctype html>

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Status Board</title>
	<meta name="description" content="">
	<meta name="author" content="Eric Barnes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="x-dns-prefetch-control" content="off"/>
	<link rel="stylesheet" media="screen" href="<?php echo URL::to_asset('css/style.css'); ?>">
	<link rel="stylesheet" media="screen" href="<?php echo URL::to_asset('themes/wood/style.css'); ?>">
</head>
<body>
	<div id="wrapper" class="clearfix">
		<section class="small" data-zip="28056" data-widget="weather"></section>
		<section class="small" data-user="laravel" data-project="laravel" data-label="open" data-widget="githubissues"></section>
		<section class="small" data-search="laravel" data-widget="twitter"></section>

		<section class="small" data-user="laravel" data-project="laravel" data-branch="skunkworks" data-widget="githubcommits"></section>
		<section class="small" data-search="helpspot" data-widget="twitter"></section>
		<section class="small" data-exchange="NASDAQ" data-symbol="GOOG" data-widget="stocks"></section>

		<!--<section class="medium" data-widget="analytics"></section>-->
		<section class="small" data-search="ericlbarnes" data-widget="twitter"></section>

	</div>
	<script>
		var SITE_URL = "<?php echo URL::to(); ?>";
		var BASE_URL = "<?php echo URL::base(); ?>";
	</script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
	<script src="<?php echo URL::to_asset('js/core.js'); ?>"></script>
</body>
</html>