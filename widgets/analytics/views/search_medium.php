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
	
	<ul class="top_search">
		<li class="clearfix head">
			<div class="views">No.</div>
			<div class="views">Visits</div>
			<div class="views">Views</div>
			<div class="views">Time</div>
			<div class="time">Views/Visit</div>
			<div class="keyword">Keyword</div>
		</li>
	<?php $num = 1;?>
	<?php foreach ($data['content'] as $key => $item): ?>

		<?php if ($num < 20): ?>
			<?php if($num == 11):?>
		</ul>
		<ul class="top_search">
			<li class="clearfix head">
				<div class="views">No.</div>
				<div class="views">Visits</div>
				<div class="views">Views</div>
				<div class="views">Time</div>
				<div class="time">Views/Visit</div>
				<div class="keyword">Keyword</div>
			</li>
			<?php endif; ?>
		<li class="clearfix">
			<div class="views"><?php echo $num;?></div>
			<div class="views"><?php echo number_format($item['ga:visits'], 0, '.', ','); ?></div>
			<div class="views"><?php echo number_format($item['ga:pageviews'], 0, '.', ','); ?></div>
			<div class="views"><?php
				$secs = $item['ga:avgTimeOnSite'] % 60;
				if($secs < 10) {
					$secs = "0".$secs;
				}
				echo sprintf("%d:%ss", (int) $item['ga:avgTimeOnSite'] / (60), $secs );?></div>
			<div class="time"><?php echo number_format($item['ga:pageviewsPerVisit'], 2); ?></div>
			<div class="keyword"><?php echo $key; ?></div>
		</li>
		<?php $num++;?>
		<?php endif; ?>
	<?php endforeach ?>
	</ul>
	<?php endif ?>
</div>
</div>