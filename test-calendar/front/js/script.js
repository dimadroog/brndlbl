jQuery(window).load( function() {
	var	url = jQuery('#mycalendar').data('jsonurl'); 
	jQuery('#mycalendar').monthly({
		mode: 'event',
		jsonUrl: url+'events.json',
		dataType: 'json',
	});
});