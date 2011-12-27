<style>
	<?php echo $css; ?>
</style>
<header>
	<h1>Github Commits <span>for <?php echo $data['project']; ?> <?php echo $data['branch'] ?></span></h1>
</header>
<div class="content github">
	<ul class="github_medium">
	<?php foreach ($data['commits'] as $key => $commit): ?>
		<?php if ($key < 5): ?>
		<li class="clearfix">
			<div class="msg">
				<?php echo HTML::link('http://github.com'.$commit['url'], Str::limit($commit['message'], 80)); ?>
			</div>
			<div class="date">
				<?php echo date("M D, h:ia", strtotime($commit['committed_date'])); ?>
			</div>
			<div class="name">
				<?php echo $commit['committer']['name'] ?>
			</div>
		</li>
		<?php endif; ?>
	<?php endforeach ?>
	</ul>
</div>

