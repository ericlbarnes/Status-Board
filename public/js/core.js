$(document).ready(function() {

	$('section').each(function(index) {
		init_widget(this);
	});

	function init_widget(widget) {
		var name = $(widget).attr("data-widget");
		var data = $(widget).data();

		// This is nasty but couldn't think
		// of a better way at this time.
		var a = [];
		for (key in data) {
			a.push(key+"="+data[key]);
		}
		a.push("size="+$(widget).attr('class'));
		var serialized = a.join("&");

		// Initial loading of widget
		load_widget(widget, name, serialized);

		// Set timer to refresh widget
		var interval = $(widget).attr('data-interval');
		if (interval) {
			setInterval(function() {
				load_widget(widget, name, serialized);
			}, interval * 1000);
		}

		return false;
	}

	function load_widget(widget, name, data) {
		$(widget).html('<div class="loading"><img src="'+BASE_URL+'/themes/wood/ajax-loader-large.gif"></div>').fadeIn();

		$.ajax({
			data: data,
			dataType: "html",
			type: "POST",
			url: SITE_URL+name+"?"+new Date().getTime(),
			success: function(data) {
				$(widget).html(data).fadeIn();
			}
		});
		return false;
	}
});