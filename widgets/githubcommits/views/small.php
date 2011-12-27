<style>
	<?php echo $css; ?>
</style>
<header>
	<h1>Github Commits <span>for <?php echo $data['project']; ?> <?php echo $data['branch'] ?></span></h1>
</header>
<div class="content github">
	<ul>
	<?php foreach ($data['commits'] as $key => $commit): ?>
		<?php if ($key < 5): ?>
		<li class="clearfix">
			<div class="msg">
				<?php echo HTML::link('http://github.com'.$commit['url'], Str::limit($commit['message'], 40)); ?>
			</div>
			<div class="name">
				<?php echo $commit['committer']['name'] ?>
			</div>
		</li>
		<?php endif; ?>
	<?php endforeach ?>
	</ul>
</div>

