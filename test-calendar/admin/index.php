<?php
// add news post type
add_action( 'init', 'events_register_post_type_init' ); // Использовать функцию только внутри хука init

function events_register_post_type_init() {
	$labels = [
		'name' => __('Events', 'test_calendar'),
		'singular_name' => __('Event', 'test_calendar'), // админ панель Добавить->Функцию
		'add_new' => __('Add Event', 'test_calendar'),
		'add_new_item' => __('Add Event', 'test_calendar'), // заголовок тега <title>
		'edit_item' => __('Edit Event', 'test_calendar'),
		'new_item' => __('New Event', 'test_calendar'),
		'all_items' => __('All Events', 'test_calendar'),
		'view_item' => __('View Events on site', 'test_calendar'),
		'search_items' => __('Search Events', 'test_calendar'),
		'not_found' =>  __('Events not found', 'test_calendar'),
		'not_found_in_trash' => __('Not found Events in trash', 'test_calendar'),
		'menu_name' => __('Events', 'test_calendar') // ссылка в меню в админке
	];
	$args = [
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-calendar', // иконка в меню
		'menu_position' => 4, // порядок в меню
		'show_in_rest' => true,
		'supports' => ['title'],
		'taxonomies' => ['tc_categories', 'tc_countries'],
	];
	register_post_type('events', $args);
}

add_action( 'init', 'create_calendar_tax' );

function create_calendar_tax() {

	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'tc_categories', [ 'events' ], [ 
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => __('Categories', 'test_calendar'),
			'singular_name'     => __('Category', 'test_calendar'),
			'search_items'      => __('Search Categories', 'test_calendar'),
			'all_items'         => __('All Categories', 'test_calendar'),
			'view_item '        => __('View Category', 'test_calendar'),
			'parent_item'       => __('Parent Category', 'test_calendar'),
			'parent_item_colon' => __('Parent Category:', 'test_calendar'),
			'edit_item'         => __('Edit Category', 'test_calendar'),
			'update_item'       => __('Update Category', 'test_calendar'),
			'add_new_item'      => __('Add new Category', 'test_calendar'),
			'new_item_name'     => __('New Category Name', 'test_calendar'),
			'menu_name'         => __('Category', 'test_calendar'),
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => false,

		'rewrite'               => ['slug' => 'tc_categories'],
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest' => true,
		'rest_base'             => null, // $taxonomy
	] );


	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'tc_countries', [ 'events' ], [ 
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => __('Countries', 'test_calendar'),
			'singular_name'     => __('Country', 'test_calendar'),
			'search_items'      => __('Search Countries', 'test_calendar'),
			'all_items'         => __('All Countries', 'test_calendar'),
			'view_item '        => __('View Country', 'test_calendar'),
			'parent_item'       => __('Parent Country', 'test_calendar'),
			'parent_item_colon' => __('Parent Country:', 'test_calendar'),
			'edit_item'         => __('Edit Country', 'test_calendar'),
			'update_item'       => __('Update Country', 'test_calendar'),
			'add_new_item'      => __('Add new Country', 'test_calendar'),
			'new_item_name'     => __('New Country Name', 'test_calendar'),
			'menu_name'         => __('Country', 'test_calendar'),
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => false,

		'rewrite'               => ['slug' => 'tc_countries'],
		'capabilities'          => array(),
		'meta_box_cb'           => false, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest' => true,
		'rest_base'             => null, // $taxonomy
	] );

}