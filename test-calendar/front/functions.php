<?php 
function test_calendar_styles() {  
	wp_register_style( 'test_calendar_custom_style', plugins_url( '/css/style.css', __FILE__ ));   
	wp_enqueue_style( 'test_calendar_custom_style' ); 



	wp_register_style( 'test_calendar_fullcalendar_core_style', plugins_url( 'lib/fullcalendar/packages/core/main.css', __FILE__ ));
	wp_enqueue_style( 'test_calendar_fullcalendar_core_style' ); 

	wp_register_style( 'test_calendar_fullcalendar_daygrid_style', plugins_url( 'lib/fullcalendar/packages/daygrid/main.css', __FILE__ ));
	wp_enqueue_style( 'test_calendar_fullcalendar_daygrid_style' ); 

	wp_register_style( 'test_calendar_fullcalendar_timegrid_style', plugins_url( 'lib/fullcalendar/packages/timegrid/main.css', __FILE__ ));
	wp_enqueue_style( 'test_calendar_fullcalendar_timegrid_style' ); 

	wp_register_style( 'test_calendar_fullcalendar_list_style', plugins_url( 'lib/fullcalendar/packages/list/main.css', __FILE__ ));
	wp_enqueue_style( 'test_calendar_fullcalendar_list_style' ); 

}
add_action( 'wp_enqueue_styles', 'test_calendar_styles' );
do_action( 'wp_enqueue_styles' );



function test_calendar_scripts() {  

	wp_register_script( 'test_calendar_fullcalendar_core_script', plugins_url( 'lib/fullcalendar/packages/core/main.js', __FILE__ ), array( 'jquery' )); 
	wp_enqueue_script( 'test_calendar_fullcalendar_core_script' ); 

	wp_register_script( 'test_calendar_fullcalendar_interaction_script', plugins_url( 'lib/fullcalendar/packages/interaction/main.js', __FILE__ ), array( 'jquery' )); 
	wp_enqueue_script( 'test_calendar_fullcalendar_interaction_script' ); 

	wp_register_script( 'test_calendar_fullcalendar_daygrid_script', plugins_url( 'lib/fullcalendar/packages/daygrid/main.js', __FILE__ ), array( 'jquery' )); 
	wp_enqueue_script( 'test_calendar_fullcalendar_daygrid_script' ); 

	wp_register_script( 'test_calendar_fullcalendar_timegrid_script', plugins_url( 'lib/fullcalendar/packages/timegrid/main.js', __FILE__ ), array( 'jquery' )); 
	wp_enqueue_script( 'test_calendar_fullcalendar_timegrid_script' ); 

	wp_register_script( 'test_calendar_fullcalendar_list_script', plugins_url( 'lib/fullcalendar/packages/list/main.js', __FILE__ ), array( 'jquery' )); 
	wp_enqueue_script( 'test_calendar_fullcalendar_list_script' );  




	wp_register_script( 'test_calendar_custom_script', plugins_url( '/js/script.js', __FILE__ ), array( 'jquery' )); 
	wp_enqueue_script( 'test_calendar_custom_script' );  
}
add_action( 'wp_enqueue_scripts', 'test_calendar_scripts' );
do_action( 'wp_enqueue_scripts' );




function create_calendar_data($shortcode_atts){
	$q_category = '';
	if ($shortcode_atts && $shortcode_atts['category']) {
		$q_category = $shortcode_atts['category'];
	}
	
	$args = [
			'posts_per_page' => -1,
			'post_type' => 'events',
			'meta_key'		=> 'event_category',
			'meta_value'	=> $q_category
	];

	$query = new WP_Query( $args );

	$array = [];
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$item = [
				'id' => get_the_id(),
				'title' => get_the_title(),
				'start' => get_field('event_date', get_the_id()),
				'country' => get_field('event_country', get_the_id())->name,
				'city' => get_field('event_city', get_the_id()),
				'category' => get_field('event_category', get_the_id())->name,
				'color' => '#cd2653',
				'purl' => get_the_permalink(),
			];

			$array[] = $item;
		} //endwile

		$json = json_encode($array);
		$json = html_entity_decode($json);
		file_put_contents(plugin_dir_path( __FILE__ ).'/lib/fullcalendar/json/events.json', $json);

	}
	wp_reset_postdata();
}

create_calendar_data($shortcode_atts);