$('section').each(function(index) {
	load_widget(this);
});

function load_widget(widget){
	$(widget).html('<div class="loading"><img src="'+BASE_URL+'/themes/wood/ajax-loader-large.gif"></div>').fadeIn();

	var data = $(widget).data();
	var name = $(widget).attr("data-widget");

	// This is nasty but couldn't think
	// of a better way at this time.
	var a = [];
	for (key in data) {
		a.push(key+"="+data[key]);
	}
	a.push("size="+$(widget).attr('class'));
	var serialized = a.join("&");

	$.ajax({
		data: serialized,
		dataType: "html",
		type: "POST",
		url: SITE_URL+name+"?"+new Date().getTime(),
		success: function(data) {
			$(widget).html(data).fadeIn();
		}
	});
	return false;
}