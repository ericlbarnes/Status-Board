<style>
	<?php echo $css; ?>
</style>
<div class="analytics">
<header>
	<h1><?php echo isset($data['widget_settings']['domain']) ? $data['widget_settings']['domain']." " : ''?><?php echo isset($data['report_settings']['name']) ? $data['report_settings']['name'] : ''?></h1>
</header>
<div class="content">
	<?php if (isset($error)): ?>
		<?php echo $error ?>
	<?php else: ?>
		<div class="chart clearfix">
			<img src="http://chart.apis.google.com/chart?
		chxl=1:|<?php echo $labels; ?>&
		chxr=0,0,<?php echo round($max + 100); ?>&
		chxt=y,x&
		chs=545x230&
		cht=lc&
		chco=ACC314&
		chds=0,<?php echo $max + 100; ?>&
		chd=t:<?php echo $visits; ?>&
		chg=14.3,-1,1,1&
		chls=2,4,0&
		chf=bg,s,EFEFEF00&
		chxs=0N,FFFFFF,12|1N,FFFFFF,12&
		chm=r,33333333,0,-0.01,0.01,1|R,33333333,0,-0.01,0.01,1&" alt="Visitor Traffic Chart" class="gchart" />
		</div>
		<div class="analytics_details clearfix">
			<h2>Total Visitors</h2>
			<div class="box round today clearfix">
					<h2><?php echo number_format($today); ?></h2>
					<h5>Today</h5>
			</div>
			<div class="box round clearfix">
					<h2><?php echo number_format($yesterday); ?></h2>
					<h5>Yesterday</h5>
			</div>
		</div>
	<?php endif ?>
</div>
</div>