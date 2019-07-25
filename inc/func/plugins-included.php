<?php

require_once dirname( __FILE__ ) . '/plugin-activation.php';

add_action( 'tgmpa_register', 'dgc_register_required_plugins' );
/**
 * Register the required plugins for dgc-network theme.
 */
function dgc_register_required_plugins() {

	$plugins = array(
		array(
			'name'    => 'Maintenance',
			'slug'    => 'maintenance',
			'required'  => false,
		),

		array(
			'name'    => 'dgc Shortcodes',
			'slug'    => 'dgc-shortcodes',
			'required'  => true,
		),
		
		array(
			'name'     				=> 'Elementor', 
			'slug'     				=> 'elementor ',
			'required' 				=> false,
		),

		array(
			'name'    => 'WPForms Lite',
			'slug'    => 'wpforms-lite',
			'required'  => false,
		),

	);

	$config = array(
		'id'           => 'dgc-wordpress-theme',                  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                          // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',  // Menu slug.
		'parent_slug'  => 'themes.php',           	   // Parent menu slug.
		'capability'   => 'edit_theme_options',   	 // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    	// Show admin notices or not.
		'dismissable'  => true,                   	 // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                     	 // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                  	 // Automatically activate plugins after installation or not.
		'message'       => '<span class="dgc-msg"><br />1. Select all plugins checkbox to the left of "Plugin" <br />2. Click "Bulk Actions" and then Install <br />3. Click "Apply" button</span>',              
		'strings'      => array(
			'page_title'                            => __( 'dgc Plugin Integration', 'dgc-wordpress-theme' ),
			'menu_title'                            => __( 'Plugin Integration', 'dgc-wordpress-theme' ),
			'installing'                            => __( 'Installing Plugin: %s', 'dgc-wordpress-theme' ), // %1$s = plugin name
			'oops'                                  => __( 'Something went wrong with the plugin API.', 'dgc-wordpress-theme' ),
			'notice_can_install_required'     => _n_noop(
				'dgc-network theme requires the following plugin: %1$s.',
				'dgc-network theme requires the following plugins: %1$s.',
				'dgc-wordpress-theme'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'dgc-network theme recommends the following plugin: %1$s.',
				'dgc-network theme recommends the following plugins: %1$s.',
				'dgc-wordpress-theme'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'dgc-wordpress-theme'
			), // %1$s = plugin name(s).
			// 'notice_ask_to_update_maybe'      => _n_noop(
				// 'There is an update available for: %1$s.',
				// 'There are updates available for the following plugins: %1$s.',
				// 'theme-slug'
			// ), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'dgc-wordpress-theme'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'dgc-wordpress-theme'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'dgc-wordpress-theme'
			),
			// 'update_link' 					  => _n_noop(
				// 'Begin updating plugin',
				// 'Begin updating plugins',
				// 'theme-slug'
			// ),
			'activate_link'                   => _n_noop(
				'Activate installed plugin',
				'Activate installed plugins',
				'dgc-wordpress-theme'
			),
			'return'                         	=> __( 'Return to Required Plugins Installer', 'dgc-wordpress-theme' ),
			'plugin_activated'                  => __( 'Plugin activated successfully.', 'dgc-wordpress-theme' ),
			//'activated_successfully'          => __( 'The following plugin was activated successfully:', 'dgc-wordpress-theme' ),
			//'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'dgc-wordpress-theme' ),  // %1$s = plugin name(s).
			//'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'dgc-wordpress-theme' ),  // %1$s = plugin name(s).
			'complete'                          => __( 'All plugins installed and activated successfully. %1$s', 'dgc-wordpress-theme' ), // %s = dashboard link.
			//'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'dgc-wordpress-theme' ),
			//'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'dgc-wordpress-theme' ),
			'nag_type'                          => 'updated', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
	); 
	

  tgmpa( $plugins, $config );
}

?>