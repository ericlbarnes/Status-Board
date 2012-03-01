<style>
	<?php echo $css; ?>
</style>
<header>
	<h1>Weather <span>for <?php echo $weather['forecast_info']['city'][0]; ?> </span></h1>
</header>
<div class="content weather">
	<div class="column">
		<h2>CUR</h2>
		<img src="<?php echo $weather['current_conditions']['icon']; ?>">
		<div class="high"><?php echo $weather['current_conditions']['temp_f'][0]; ?>&deg;</div>
	</div>
	<?php if (isset($weather['forecast'])): ?>
		<?php foreach($weather['forecast'] as $key => $day): ?>
			<?php if ($key < 3): ?>
				<div class="column">
					<h2><?php echo strtoupper(trim($day['day_of_week'])) ?></h2>
					<img src="<?php echo $day['icon'] ?>">
					<div class="high"><?php echo $day['high'] ?>°</div>
					<div class="low"><?php echo $day['low'] ?>°</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif ?>
</div>

