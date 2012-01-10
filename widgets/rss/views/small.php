<style>
	<?php echo $css; ?>
</style>
<header>
	<h1><?= $site?></h1>
</header>
<div class="content github">


	<?php if (is_array($rss_feed)): ?>
		<ul class="feed_list">
     	<?php foreach ($rss_feed as $feed):?>

     		<li class="clearfix">
          		<a href="<?= $feed['link']?>" title="<?= $feed['title']?>"><?= $feed['title']?></a>
     		</li>
     	<?php endforeach;?>
		</ul>
     <?php  else:?>
     	<div><h3><?= $rss_feed?></h3></div>
     <?php endif;?>
</div>