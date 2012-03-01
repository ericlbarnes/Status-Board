<style>
	<?php echo $css; ?>
</style>
<header>
	<h1>Time</h1>
</header>
<div class="content time">
	<h2></h2>
</div>
<script>
	$(document).ready(function() {
		var time = $('.content.time h2');

		update_time(time);

		setInterval(function() {
			update_time(time);
		}, 1000);

		function update_time(element) {
			var currentTime = new Date();

			var currentHours = currentTime.getHours();
			var currentMinutes = currentTime.getMinutes();
			var currentSeconds = currentTime.getSeconds();

			// Pad the minutes and seconds with leading zeros, if required
			currentMinutes = (currentMinutes < 10 ? '0' : '')+currentMinutes;
			currentSeconds = (currentSeconds < 10 ? '0' : '')+currentSeconds;

			// Choose either "AM" or "PM" as appropriate
			var timeOfDay = (currentHours < 12) ? 'AM' : 'PM';

			// Convert the hours component to 12-hour format if needed
			currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;

			// Convert an hours component of "0" to "12"
			currentHours = (currentHours == 0) ? 12 : currentHours;

			// Compose the string for display
			var currentTimeString = currentHours+':'+currentMinutes+':'+currentSeconds+' '+timeOfDay;

			// Update the time display
			$(element).html(currentTimeString).fadeIn();
		}
	});
</script>