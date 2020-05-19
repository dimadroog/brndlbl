<?php /*
	Plugin Name: Test Calendar
	Description: A test Calendar. Calls with shortcode [test_calendar] in theme or any post
	* Text Domain: test_calendar
	* Domain Path: /lang
	*/

	add_action( 'plugins_loaded', function(){
		load_plugin_textdomain( 'test_calendar', false, dirname( plugin_basename(__FILE__) ) . '/lang' );
	} );

	function test_calendar_shortcode_function($shortcode_atts) {
		ob_start (); 
		include plugin_dir_path( __FILE__ ) . '/front/functions.php';
		include_once(plugin_dir_path( __FILE__ ) . 'front/index.php');
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	add_shortcode('test_calendar', 'test_calendar_shortcode_function');



	// admin settings
	include plugin_dir_path( __FILE__ ) . '/admin/index.php';
	
 ?>