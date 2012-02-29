<style>
	<?php echo $css; ?>
</style>
<div class="analytics">
<header>
	<h1><?php echo isset($data['widget_settings']['domain']) ? $data['widget_settings']['domain']." " : ''?><?php echo isset($data['report_settings']['name']) ? $data['report_settings']['name'] : ''?></h1>
</header>
<div class="content top_content">
	<?php if (isset($error)): ?>
		<?php echo $error ?>
	<?php else: ?>
	
	<ul class="top_content_feed">
		<li class="clearfix head">
			<div class="views">Views</div>
			<div class="time">/Visit</div>
			<div class="msg">Page</div>
		</li>
	<?php $num = 0;?>
	<?php foreach ($data['content'] as $key => $item): ?>
		<?php if ($num < 10): ?>
		<li class="clearfix">
			<div class="views"><?php echo number_format($item['ga:pageviews'], 0, '.', ','); ?></div>
			<div class="time"><?php echo number_format($item['ga:pageviewsPerVisit'], 0, '.', ','); ?></div>
			<div class="msg">
				<?php $key_name = preg_replace("/^\/".$data['widget_settings']['domain']."/", "", $key); ?>
				<?php echo HTML::link("http://".$key, $key_name); ?> 
			</div>
		</li>
		<?php $num++;?>
		<?php endif; ?>
	<?php endforeach ?>
	</ul>
	<?php endif ?>
</div>
</div>