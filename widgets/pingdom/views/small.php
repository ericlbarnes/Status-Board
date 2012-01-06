<style>
	<?php echo $css; ?>
</style>
<header>
	<h1>Pingdom Status</h1>
</header>
<div class="content pingdom">
	<ul class="pingdom_checks">
	<?php foreach ($data['checks'] as $key => $item): ?>
		<?php if ($key < 2): ?>
		<li class="clearfix">
			<div class="msg <?php echo $item->status;?>">
				<a href="http://<?php echo $item->hostname;?>" title="<?php echo $item->name;?>"><?php echo $item->hostname;?></a>
				<div class="b-server-time clrfix">
					<div class="b-server-downtime">
						<div class="t-size-x11 t-small">Last downtime</div>
						<div class="t-size-x18 t-main"><?php echo $item->lasterrortime_pretty;?></div>
					</div>
					<div class="b-server-uptime">
						<div class="t-size-x11 t-small">Response time</div>
						<div class="t-size-x18 t-main"><?php echo $item->lastresponsetime;?>ms</div>
					</div>
				</div>
				<div class="b-server-time clrfix">
					<div class="b-server-downtime">
						<div class="t-size-x11 t-small">Last test</div>
						<div class="t-size-x18 t-main"><?php echo $item->lasttesttime_pretty;?></div>
					</div>
					<div class="b-server-uptime">
						<div class="t-size-x11 t-small">Test frequency</div>
						<div class="t-size-x18 t-main"><?php echo $item->resolution;?>mins</div>
					</div>
					<div class="status <?php echo $item->status;?>"></div>
				</div>
			</div>
		</li>
		<?php endif; ?>
	<?php endforeach ?>
	</ul>
</div>