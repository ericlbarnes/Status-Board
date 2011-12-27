
// Ajax Wrapper - http://bit.ly/f9t2wV
var sb_ajax = ( function( $, undefined ) {
	return (
		function( params ) {
			// use extend to merge our defaults with parameters
			// passed by function caller
			var settings = $.extend({
				url: "",
				spinner: undefined,
				dataType: "html",
				type: "POST",
				cache:    false,
				success:  function(){},
				errorMsg: "Oops. Sorry about that."
			}, params),
			retries = 0; // setting up retries variable
			// setting up a function that we can call recursively
			// to retry ajax calls
			function ajaxRequest ( ) {
				$.ajax({
					beforeSend: function() {
						$( settings.spinner ).fadeIn();
					},
					url: settings.url,
					type: settings.type,
					data: settings.data,
					dataType: settings.dataType,
					success: settings.success,
					complete: function() {
						$( settings.spinner ).fadeOut('slow');
					},
					error: function( xhr, tStatus, err ) {
						if( xhr.status === 401 || xhr.status === 403 ) {
							//redirect action here
						} else if ( xhr.status === 504 && !retries++ ) {
							//make our recursive request
							ajaxRequest();
						} else {
							$(document).trigger( "ui-flash-message",
							[{ message: settings.errorMsg }] );
						}
					} // end error handler
				}); // end $.ajax()
			}; // end ajaxRequest()
			ajaxRequest();
		} // end getViaAjax()
	); // end return statement
})(jQuery);

$('section').each(function(index) {
	load_widget(this);
});
function load_widget(widget){
	$(widget).html('Loading...');
	var data = $(widget).data();

	// This is nasty but couldn't think 
	// of a better way at this time.
	var a = [];
	for (key in data) {
		a.push(key+"="+data[key]);
	}
	a.push("size="+$(widget).attr('class'));
	var serialized = a.join("&")
	console.log(serialized);
	var name = $(widget).attr("data-widget");
	sb_ajax({
		data: serialized,
		url: SITE_URL+name+"?"+new Date().getTime(),
		success: function(data) {
			$(widget).html(data);
		}
	});
	return false;
}