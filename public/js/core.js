$(document).ready(function() {

	$('section').each(function(index) {
		init_widget(this);
	});
	
	$("div.sortable").sortable({
		update: save_widget_positions,
		placeholder: "ui-state-highlight",
		opacity: 0.35,
		distance: 30,
		forcePlaceholderSize: true,
		items: 'section',
		revert: true
	});
	$( "div.sortable" ).disableSelection();
	
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

	function save_widget_positions() {
		// get the widget config values
		var a = [];
		$('section').each(function(item){
			a.push($(this).attr('data-config'));
		});
		
		var names = a.join(",");
		
		$.ajax({
			data: {names: names},
			dataType: "html",
			type: "POST",
			url: SITE_URL+"save"+"?"+new Date().getTime(),
			success: function(data) {
				// place nice user message here
			}
		});
		//return false;
	}
});