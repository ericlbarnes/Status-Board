<!doctype html>

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $page_title;?></title>
	<meta name="description" content="">
	<meta name="author" content="Eric Barnes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="x-dns-prefetch-control" content="off"/>
	<link rel="stylesheet" media="screen" href="<?php echo URL::to_asset('css/style.css'); ?>">
	<link rel="stylesheet" media="screen" href="<?php echo URL::to_asset('themes/'.$theme.'/style.css'); ?>">
</head>
<body>
	<div id="wrapper" class="clearfix">
<?php if (count($widgets)): ?>
	<?php foreach ($widgets as $key => $widget): ?>
		<?php if(is_array($widget) && isset($widget['class']) && isset($widget['widget'])): ?>
		<section class="<?php echo $widget['class'];?>" <?php if (isset($widget['interval'])):?>data-interval="<?php echo $widget['interval'];?>" <?php endif;?>data-config="<?php echo $key;?>" data-widget="<?php echo $widget['widget'];?>"></section>
		<?php endif;?>
	<?php endforeach;?>
<?php else:?>
		<div class="error">Error: There are no board settings setup</div>
<?php endif;?>
	</div>
	<script>
		var SITE_URL = "<?php echo URL::to(); ?>";
		var BASE_URL = "<?php echo URL::base(); ?>";
	</script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/js/libs/jquery-1.6.2.min.js"><\/script>')</script>
	<script src="<?php echo URL::to_asset('js/core.js'); ?>"></script>
</body>
</html>