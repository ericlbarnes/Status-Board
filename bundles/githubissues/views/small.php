<style>
	<?php echo $css; ?>
</style>
<header>
	<h1>Github Issues <span>for <?php echo $data['project']; ?> </span></h1>
</header>
<div class="content github">
	<ul>
	<?php foreach ($data['issues'] as $key => $issue): ?>
		<?php if ($key < 5): ?>
		<li><?php echo HTML::link($issue['html_url'], $issue['title']); ?></li>
		<?php endif; ?>
	<?php endforeach ?>
	</ul>
</div>

