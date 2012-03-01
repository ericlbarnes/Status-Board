<style>
	<?php echo $css; ?>
</style>
<header>
	<h1>Stock Info <span>for <?php echo $data['exchange']; ?>:<?php echo $data['symbol']; ?> </span></h1>
</header>
<div class="content stocks">
	<h2><?php echo $data['price']; ?> <span class="<?php echo $data['change_class']; ?>"><?php echo $data['change']; ?></span></h2>
	<span class="time"><?php echo $data['time']; ?></span>
</div>