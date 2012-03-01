<style>
	<?php echo $css; ?>
</style>
<header>
	<h1>Twitter Search <span>for <?php echo $data['search']; ?> </span></h1>
</header>
<div class="content twitter">
	<ul class="twitter_feed">
	<?php foreach ($data['messages'] as $key => $item): ?>
		<?php if ($key < 5): ?>
		<li class="clearfix">
			<div class="msg">
				<?php echo HTML::link('http://twitter.com/'.$item->from_user.'/status/'.$item->id_str, Str::limit($item->text, 40)); ?>
			</div>
			<div class="name">
				<?php echo $item->from_user ?>
			</div>
		</li>
		<?php endif; ?>
	<?php endforeach ?>
	</ul>
</div>