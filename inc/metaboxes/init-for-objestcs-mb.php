<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category dgc-wordpress-theme
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

 
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 999 );
function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) ) {
		require_once dirname(__FILE__) . '/init.php';
		require_once dirname(__FILE__) . '/custom-fields-for-metaboxes.php';
	}	
	
}

add_filter( 'cmb_meta_boxes', 'dgc_all_metaboxes', 10, 2 );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function dgc_all_metaboxes( array $meta_boxes ) {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_dgc_';
	
	$meta_boxes['dgc_slider_settings'] = array(
		'id'         => 'dgc_slider_settings',
		'title'      => __( 'Slider settings', 'taxonomy' ),
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true, 
		'pages'      => array( 'page'), 
		//'show_on'	 =>	array( 'key'=>'front-page', 'value' => '' ),
		'fields'     => array(
				array(
					'name' 		=> __('Slider display', 'taxonomy'),
					'id' 		=> $prefix . 'slider_layout',
					'subname'   => __('Select the option to display the corresponding slider', 'taxonomy'),
					'std' 		=> '0',
					'options' 	=> array(
										'0' => __('Disable slider', 'taxonomy'),
										'1' => __('Full width slider', 'taxonomy'),
										'2' => __('Boxed slider', 'taxonomy'),
										),
					'type' => 'select'
				),
		),
	);
	
	// Only with sidebar enabled
	$meta_boxes['dgc_page_general_settings'] = array(
		'id'         => 'dgc_page_general_settings',
		'title'      => __( 'Page settings', 'taxonomy' ),
		'pages'      => array( 'page'), 
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true, 
		'fields'     => array(
			array(
				'name' 		=> __( 'Layout', 'taxonomy' ),
				'subname' 	=> __( 'Select a specific layout for this page.', 'taxonomy' ),
				'id'      	=> $prefix . 'page_layout',
				'type' 	  	=> 'custom_layout_sidebars',
				'default' 	=> '0'
			),
		),
	);
	
	
	$meta_boxes['dgc_post_general_settings'] = array(
		'id'         => 'dgc_post_general_settings',
		'title'      => __( 'Post settings', 'taxonomy' ),
		'pages'      => array( 'post'), 
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true, 
		'fields'     => array(
			array(
				'name' 		=> __( 'Layout', 'taxonomy' ),
				'subname' 	=> __( 'Select a specific layout for this post.', 'taxonomy' ),
				'id' 		=> $prefix . 'page_layout',
				'type' 		=> 'custom_layout_sidebars',
				'default' 	=> '0'
			),
		),
	);
	
	
	return $meta_boxes;
}	