<style>
	<?php echo $css; ?>
</style>
<header>
	<h1>Authentic Jobs </span></h1>
</header>
<div class="content github">
	<?php if (is_array($authenticjobs)): ?>
		<ul class="job_list">
     	<?php foreach ($authenticjobs as $authjob):?>
     		<li class="clearfix">
          		<div class="title"><a href="http://authjo.bz/j/<?= $authjob['id']?>"><?= $authjob['title']?></a></div>
          		<div class="secondary"><?= $authjob['company']?></div>
          		<div class="secondary"><?= $authjob['location_city']?></div>
     		</li>
     	<?php endforeach;?>
		</ul>
     <?php  else:?>
     	<div><h3><?= $authenticjobs?></h3></div>
     <?php endif;?>
</div>