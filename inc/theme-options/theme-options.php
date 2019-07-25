<?php
/**
 * dgc-network theme Theme Options
 *
 * @package dgc-network theme
 * @since dgc-network theme 1.0
 */

/**
 * Register the form setting for our dgc_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, dgc_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since dgc-network theme 1.0
 */
class dgc_theme_options {
	public $args = array();
	public $sections = array();

	public function __construct() {
		add_action( 'init', array( $this, 'init_settings' ), 11 );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'add_menu_item' ) );
		add_action( 'admin_bar_menu', array( $this, 'dgc_add_custom_link_options' ), 1000 );
	}

	public function init_settings() {
		$this->settings_fields();
		$this->setArguments();
		if ( ! isset( $this->args['opt_name'] ) ) {
			return;
		}
	}

	public function settings_fields() {

		/*General*/

		$this->sections['general'] = array(
			'title'  => __( 'General', 'dgc-wordpress-theme' ),
			'id'     => 'general',
			'fields' => array(
				array(
					'id'          => 'responsive',
					'label'       => __( 'Layout', 'dgc-wordpress-theme' ),
					'info'        => __( 'Theme supported 2 types of html layout. Default responsive setting which adapt for mobile devices and static page with fixed width. Uncheck arrow below if you need static website display',
						'dgc-wordpress-theme' ),
					'description' => __( 'Responsive', 'dgc-wordpress-theme' ),
					'type'        => 'checkbox',
					'default'     => 'on',
				),
				array(
					'id'     => 'pagecomment_ch',
					'label'  => __( 'Comments', 'dgc-wordpress-theme' ),
					'info'   => __( 'If you want to display comments on your post page or page, select options below.',
						'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'          => 'postcomment',
							'description' => __( 'Display comment on posts page', 'dgc-wordpress-theme' ),
							'type'        => 'checkbox',
							'default'     => 'on',
						),
						array(
							'id'          => 'pagecomment',
							'description' => __( 'Display comment on page', 'dgc-wordpress-theme' ),
							'type'        => 'checkbox',
							'default'     => 'on',
						),
					)
				),
				// array(
				// 'id' 			=> 'styletheme',
				// 'label'			=> __( 'Default theme styles' , 'dgc-wordpress-theme' ),
				// 'info'          => __( 'Default CSS. Theme option for styling is not working, if this option enable.', 'dgc-wordpress-theme' ),
				// 'description'	=> __( 'Enable', 'dgc-wordpress-theme' ),
				// 'type'			=> 'checkbox',
				// 'default'		=> 'off',
				// ),
				array(
					'id'      => 'latest_posts_templ',
					'label'   => __( 'Front page template with latest posts', 'dgc-wordpress-theme' ),
					'info'    => __( 'Settings > Reading > Front page displays > Your latest posts', 'dgc-wordpress-theme' ),
					'type'    => 'select',
					'options' => array(
						'0' => __( 'Full width', 'dgc-wordpress-theme' ),
						'1' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
						'2' => __( 'Left sidebar', 'dgc-wordpress-theme' )
					),
					'default' => '0'
				),
				array(
					'label'  => __( 'Page templates by default', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose default display for templates.', 'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'layout_page_templ',
							'type'      => 'select',
							'box-title' => __( 'Page:', 'dgc-wordpress-theme' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
								'0' => __( 'Full width', 'dgc-wordpress-theme' ),
								'2' => __( 'Left sidebar', 'dgc-wordpress-theme' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_single_templ',
							'type'      => 'select',
							'box-title' => __( 'Single Post:', 'dgc-wordpress-theme' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
								'0' => __( 'Full width', 'dgc-wordpress-theme' ),
								'2' => __( 'Left sidebar', 'dgc-wordpress-theme' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_archive_templ',
							'type'      => 'select',
							'box-title' => __( 'Archive:', 'dgc-wordpress-theme' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
								'0' => __( 'Full width', 'dgc-wordpress-theme' ),
								'2' => __( 'Left sidebar', 'dgc-wordpress-theme' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_author_templ',
							'type'      => 'select',
							'box-title' => __( 'Author:', 'dgc-wordpress-theme' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
								'0' => __( 'Full width', 'dgc-wordpress-theme' ),
								'2' => __( 'Left sidebar', 'dgc-wordpress-theme' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_cat_templ',
							'type'      => 'select',
							'box-title' => __( 'Category:', 'dgc-wordpress-theme' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
								'0' => __( 'Full width', 'dgc-wordpress-theme' ),
								'2' => __( 'Left sidebar', 'dgc-wordpress-theme' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_tag_templ',
							'type'      => 'select',
							'box-title' => __( 'Tags:', 'dgc-wordpress-theme' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
								'0' => __( 'Full width', 'dgc-wordpress-theme' ),
								'2' => __( 'Left sidebar', 'dgc-wordpress-theme' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_404_templ',
							'type'      => 'select',
							'box-title' => __( '404:', 'dgc-wordpress-theme' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
								'0' => __( 'Full width', 'dgc-wordpress-theme' ),
								'2' => __( 'Left sidebar', 'dgc-wordpress-theme' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_search_templ',
							'type'      => 'select',
							'box-title' => __( 'Search:', 'dgc-wordpress-theme' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
								'0' => __( 'Full width', 'dgc-wordpress-theme' ),
								'2' => __( 'Left sidebar', 'dgc-wordpress-theme' )
							),
							'default'   => '1'
						),
					)
				),
				array(
					'id'          => 'show_featured_single',
					'label'       => __( 'Show Featured image on single post', 'dgc-wordpress-theme' ),
					'info'        => __( 'Select option below for show featured image on single post page.',
						'dgc-wordpress-theme' ),
					'description' => __( 'Show featured image', 'dgc-wordpress-theme' ),
					'type'        => 'checkbox',
					'default'     => 'on',
				),

				( ( function_exists( 'icl_get_languages' ) ) ?
					array(
						'id'          => 'is_wpml_ready',
						'type'        => 'checkbox',
						'label'       => __( 'Multilingual Switch in Header (WPML)', 'dgc-wordpress-theme' ),
						'info'        => __( 'If you wish to show Language Switch in header, select option below.',
							'dgc-wordpress-theme' ),
						'description' => __( 'Enable', 'dgc-wordpress-theme' ),
						'default'     => 'off'
					) :
					array(
						'id'      => 'reset',
						'label'   => __( 'Reset options', 'dgc-wordpress-theme' ),
						'info'    => __( 'All theme options will be reset to default.', 'dgc-wordpress-theme' ),
						'type'    => 'button',
						'default' => __( 'Reset Defaults', 'dgc-wordpress-theme' ),
						'class'   => 'button-primary reset-btn',
					)
				),
				array(
					'id'      => 'reset',
					'label'   => __( 'Reset options', 'dgc-wordpress-theme' ),
					'info'    => __( 'All theme options will be reset to default.', 'dgc-wordpress-theme' ),
					'type'    => 'button',
					'default' => __( 'Reset Defaults', 'dgc-wordpress-theme' ),
					'class'   => 'button-primary reset-btn',
				),
			)
		);


		/*Header*/

		$this->sections['header'] = array(
			'title'  => __( 'Header', 'dgc-wordpress-theme' ),
			'id'     => 'header',
			'fields' => array(
				array(
					'id'          => 'is_fixed_header',
					'label'       => __( 'Sticky  header', 'dgc-wordpress-theme' ),
					'info'        => __( 'Options relating to the website header', 'dgc-wordpress-theme' ),
					'description' => __( 'Enabled', 'dgc-wordpress-theme' ),
					'type'        => 'checkbox',
					'default'     => 'on',
				),
				array(
					'id'      => 'menu_position',
					'label'   => __( 'Menu Position', 'dgc-wordpress-theme' ),
					'info'    => __( 'Set menu position.', 'dgc-wordpress-theme' ),
					'type'    => 'select',
					'options' => array(
						'2' => __( 'Right', 'dgc-wordpress-theme' ),
						'0' => __( 'Left', 'dgc-wordpress-theme' ),
						'1' => __( 'Center', 'dgc-wordpress-theme' )
					),
					'default' => '2'
				),
				array(
					'id'      => 'menu_type_responsive',
					'label'   => __( 'Type of Responsive menu', 'dgc-wordpress-theme' ),
					'info'    => __( 'Set type of responsive menu.', 'dgc-wordpress-theme' ),
					'type'    => 'select',
					'options' => array(
						'inside_content' => __( 'Select menu', 'dgc-wordpress-theme' ),
						'full_width'     => __( 'Button menu', 'dgc-wordpress-theme' )
					),
					'default' => 'inside_content'
				),
				array(
					'id'      => 'menu_icon_color',
					'label'   => __( 'Menu icon color', 'dgc-wordpress-theme' ),
					'info'    => __( 'Chose color for collapsing menu icon', 'dgc-wordpress-theme' ),
					'type'    => 'color',
					'default' => '#333333',
				),
				array(
					'label'  => __( 'Background for header', 'dgc-wordpress-theme' ),
					'info'   => __( 'Upload image with full width for background in header area. (Supported files .png, .jpg, .gif)',
						'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'header_img',
							'type'      => 'image',
							'imagetype' => 'headerbackground',
						),
						array(
							'id'        => 'header_bg_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Header background-color', 'dgc-wordpress-theme' )
						)
					)
				),
				array(
					'id'      => 'header_img_size',
					'label'   => __( 'Background image size', 'dgc-wordpress-theme' ),
					'info'    => __( 'Choose size for background image - full width or only for content area.',
						'dgc-wordpress-theme' ),
					'type'    => 'select',
					'options' => array(
						'full'     => __( 'Full width position', 'dgc-wordpress-theme' ),
						'centered' => __( 'Centered position', 'dgc-wordpress-theme' )
					),
					'default' => 'full'
				),
				array(
					'id'      => 'header_height',
					'label'   => __( 'Height for header area', 'dgc-wordpress-theme' ),
					'info'    => __( 'Minimum height in pixels', 'dgc-wordpress-theme' ),
					'type'    => 'text',
					'default' => '80',
				),
			)
		);

		/*Background*/

		$this->sections['background'] = array(
			'title'  => __( 'Background', 'dgc-wordpress-theme' ),
			'id'     => 'background',
			'fields' => array(
				array(
					'label'  => __( 'Background Image', 'dgc-wordpress-theme' ),
					'info'   => __( 'Upload your background image for site background. (Supported files .png, .jpg, .gif)',
						'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'backgroung_img',
							'type'      => 'image',
							'imagetype' => 'headerbackground',
						),
						array(
							'id'          => 'bg_repeating',
							'description' => __( 'Background repeat', 'dgc-wordpress-theme' ),
							'type'        => 'checkbox',
							'default'     => 'off',
						),
					)
				),
				array(
					'id'      => 'background_color',
					'label'   => __( 'Background Color', 'dgc-wordpress-theme' ),
					'info'    => __( 'Choose color for body background', 'dgc-wordpress-theme' ),
					'type'    => 'color',
					'default' => '#ffffff'
				),
				array(
					'id'      => 'container_bg_color',
					'label'   => __( 'Background color for content', 'dgc-wordpress-theme' ),
					'info'    => __( 'Choose color for main content area', 'dgc-wordpress-theme' ),
					'type'    => 'color',
					'default' => '#ffffff'
				),
			)
		);

		/*Logo*/
		$this->sections['logo'] = array(
			'title'  => __( 'Logo', 'dgc-wordpress-theme' ),
			'id'     => 'logo',
			'fields' => array(
				array(
					'id'      => 'logo_position',
					'label'   => __( 'Logo Position', 'dgc-wordpress-theme' ),
					'info'    => __( 'Set Logo Position', 'dgc-wordpress-theme' ),
					'type'    => 'select',
					'options' => array(
						'0' => __( 'Left', 'dgc-wordpress-theme' ),
						'1' => __( 'Center', 'dgc-wordpress-theme' ),
						'2' => __( 'Right', 'dgc-wordpress-theme' )
					),
					'default' => '0'
				),
				array(
					'label'  => __( 'Logo size', 'dgc-wordpress-theme' ),
					'info'   => __( 'Specify resolution for your logo image', 'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'logo_w',
							'type'      => 'text',
							'default'   => '0',
							'box-title' => __( 'Width', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'logo_h',
							'type'      => 'text',
							'default'   => '0',
							'box-title' => __( 'Height', 'dgc-wordpress-theme' )
						),
					)
				),
				array(
					'id'        => 'logo_img',
					'label'     => __( 'Logo image', 'dgc-wordpress-theme' ),
					'info'      => __( 'Upload logo image for your website. Size is original (Supported files .png, .jpg, .gif)',
						'dgc-wordpress-theme' ),
					'type'      => 'image',
					'imagetype' => 'logo',
				),
				array(
					'id'        => 'logo_img_retina',
					'label'     => __( 'Logo image retina', 'dgc-wordpress-theme' ),
					'info'      => __( 'Upload logo in double size (If your logo is 100 x 20px, it should be 200 x 40px)',
						'dgc-wordpress-theme' ),
					'type'      => 'image',
					'imagetype' => 'logo_retina',
				),
				array(
					'id'        => 'fav_icon',
					'label'     => __( 'Favicon', 'dgc-wordpress-theme' ),
					'info'      => __( 'A favicon is a 16x16 pixel icon that represents your site; upload your custom Favicon here.',
						'dgc-wordpress-theme' ),
					'type'      => 'image',
					'imagetype' => 'favicon',
				),
				array(
					'id'        => 'fav_icon_iphone',
					'label'     => __( 'Favicon iPhone', 'dgc-wordpress-theme' ),
					'info'      => __( 'Upload a custom favicon for iPhone (57x57 pixel png).', 'dgc-wordpress-theme' ),
					'type'      => 'image',
					'imagetype' => 'favicon_iphone',
				),
				array(
					'id'        => 'fav_icon_iphone_retina',
					'label'     => __( 'Favicon iPhone Retina', 'dgc-wordpress-theme' ),
					'info'      => __( 'Upload a custom favicon for iPhone retina (114x114 pixel png).', 'dgc-wordpress-theme' ),
					'type'      => 'image',
					'imagetype' => 'favicon_iphone_retina',
				),
				array(
					'id'        => 'fav_icon_ipad',
					'label'     => __( 'Favicon iPad', 'dgc-wordpress-theme' ),
					'info'      => __( 'Upload a custom favicon for iPad (72x72 pixel png).', 'dgc-wordpress-theme' ),
					'type'      => 'image',
					'imagetype' => 'favicon_ipad',
				),
				array(
					'id'        => 'fav_icon_ipad_retina',
					'label'     => __( 'Favicon iPad Retina', 'dgc-wordpress-theme' ),
					'info'      => __( 'Upload a custom favicon for iPhone retina (144x144 pixel png).', 'dgc-wordpress-theme' ),
					'type'      => 'image',
					'imagetype' => 'favicon_ipad_retina',
				),

			)
		);

		/*Colors*/
		$this->sections['colors'] = array(
			'title'  => __( 'Colors', 'dgc-wordpress-theme' ),
			'id'     => 'main-colors',
			'fields' => array(
				array(
					'id'     => 'menu-color',
					'label'  => __( 'Main menu color', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose your colors for main menu in header', 'dgc-wordpress-theme' ),
					'newrow' => true,
					'fields' => array(
						array(
							'id'        => 'menu_bg_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Background color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'menu_btn_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Menu button color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'menu_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Font color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'menu_hover_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Font color (active and hover)', 'dgc-wordpress-theme' )
						),
					)
				),
				array(
					'id'     => 'dd-menu-color',
					'label'  => __( 'Dropdown menu color', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose your colors for dropdown menu in header', 'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'dd_menu_bg_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Background color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'dd_menu_btn_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Menu button color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'dd_menu_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Font color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'dd_menu_hover_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Font color (active and hover)', 'dgc-wordpress-theme' )
						),
					)
				),
				array(
					'id'     => 'g-menu-color',
					'label'  => __( 'General font color', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose your colors for text and links', 'dgc-wordpress-theme' ),
					'newrow' => true,
					'fields' => array(
						array(
							'id'        => 'p_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Font color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'a_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Link color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'a_hover_font_color',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Link color (hover)', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'a_focus_font_color',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Link color (focus)', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'a_active_font_color',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Link color (active)', 'dgc-wordpress-theme' )
						),
					)
				),
				array(
					'id'     => 'lines-color',
					'label'  => __( 'Color for lines', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose your colors for lines and separators', 'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'widgets_sep_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Widget separator color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'date_of_post_b_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Blog post date color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'date_of_post_f_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Date font color', 'dgc-wordpress-theme' )
						),
					)
				),
				array(
					'id'     => 'buttons-color',
					'label'  => __( 'Color for buttons', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose your colors for buttons', 'dgc-wordpress-theme' ),
					'newrow' => true,
					'fields' => array(
						array(
							'id'        => 'btn_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Button background color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'btn_active_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Button background color (hover, active, focus, current page - pagenavi)',
								'dgc-wordpress-theme' )
						),
					)
				),
				array(
					'id'     => 'social-color',
					'label'  => __( 'Color for social icons', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose your colors for social icons', 'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'soc_icon_bg_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Social icons background color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'soc_icon_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Button background color (hover, active, focus, current page - pagenavi)',
								'dgc-wordpress-theme' )
						),
					)
				),
				array(
					'id'     => 'woocommerce-color',
					'label'  => __( 'WooCommerce colors', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose your colors for WooCommerce', 'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'woo_sale_price_color',
							'type'      => 'color',
							'default'   => '#919191',
							'box-title' => __( 'Sale price color', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'woo_rating_color_regular',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Rating color (regular)', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'woo_rating_color_active',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Rating color (hover, active)', 'dgc-wordpress-theme' )
						),
					)
				),
			)
		);

		/*Fonts*/
		$this->sections['fonts'] = array(
			'title'  => __( 'Fonts', 'dgc-wordpress-theme' ),
			'id'     => 'fonts',
			'fields' => array(
				// array(
				// 'label'			=> __( 'Fonts' , 'dgc-wordpress-theme' ),
				// 'info'			=> __( 'Popular web safe font collection, select and use for your needs.', 'dgc-wordpress-theme' ),
				// ),
				array(
					'id'      => 'h_font_family',
					'label'   => __( 'Headers', 'dgc-wordpress-theme' ),
					'info'    => __( 'Choose font-family for all headlines.', 'dgc-wordpress-theme' ),
					'type'    => 'font',
					'options' => dgc_fonts_list(),
					'default' => 'Open Sans, sans-serif',
				),
				array(
					'id'      => 'm_font_family',
					'label'   => __( 'Menu', 'dgc-wordpress-theme' ),
					'info'    => __( 'Choose font-family for primary menu.', 'dgc-wordpress-theme' ),
					'type'    => 'font',
					'options' => dgc_fonts_list(),
					'default' => 'Open Sans, sans-serif',
				),
				array(
					'id'      => 'p_font_family',
					'label'   => __( 'Body', 'dgc-wordpress-theme' ),
					'info'    => __( 'Choose font-family for content.', 'dgc-wordpress-theme' ),
					'type'    => 'font',
					'options' => dgc_fonts_list(),
					'default' => 'Open Sans, sans-serif',
				),
				array(
					'id'     => 'font-size',
					'label'  => __( 'Font size', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose font size for specific html elements. Set size as number, without px..',
						'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'h1_size',
							'type'      => 'text',
							'default'   => '27',
							'box-title' => __( 'H1', 'dgc-wordpress-theme' ),
						),
						array(
							'id'        => 'h2_size',
							'type'      => 'text',
							'default'   => '34',
							'box-title' => __( 'H2', 'dgc-wordpress-theme' ),
						),
						array(
							'id'        => 'h3_size',
							'type'      => 'text',
							'default'   => '18',
							'box-title' => __( 'H3', 'dgc-wordpress-theme' ),
						),
						array(
							'id'        => 'h4_size',
							'type'      => 'text',
							'default'   => '17',
							'box-title' => __( 'H4', 'dgc-wordpress-theme' ),
						),
						array(
							'id'        => 'h5_size',
							'type'      => 'text',
							'default'   => '14',
							'box-title' => __( 'H5', 'dgc-wordpress-theme' ),
						),
						array(
							'id'        => 'h6_size',
							'type'      => 'text',
							'default'   => '12',
							'box-title' => __( 'H6', 'dgc-wordpress-theme' ),
						),
						array(
							'id'        => 'm_size',
							'type'      => 'text',
							'default'   => '14',
							'box-title' => __( 'Menu', 'dgc-wordpress-theme' ),
						),
						array(
							'id'        => 'p_size',
							'type'      => 'text',
							'default'   => '14',
							'box-title' => __( 'P', 'dgc-wordpress-theme' ),
						),
					)
				)

			),
		);

		/*Slider*/
		$this->sections['slider'] = array(
			'title'  => __( 'Slider', 'dgc-wordpress-theme' ),
			'id'     => 'slider',
			'fields' => array(
				array(
					'id'      => 'select_slider',
					'class'   => 'select-slider',
					'label'   => __( 'Slider', 'dgc-wordpress-theme' ),
					'info'    => __( 'Select a slider type that will be used by default.', 'dgc-wordpress-theme' ),
					'type'    => 'select',
					'options' => array(
						'1' => __( 'FlexSlider', 'dgc-wordpress-theme' ),
						'2' => __( 'Nivo Slider', 'dgc-wordpress-theme' )
					),
					'default' => '1'
				),
				array(
					'id'     => 'slider-options',
					'label'  => __( 'Slider Options', 'dgc-wordpress-theme' ),
					'info'   => __( 'Choose needed options for slider: animation type, sliding direction, speed of animations, etc',
						'dgc-wordpress-theme' ),
					'type'   => 'slider-options',
					'fields' => array(
						array(
							'id'           => 's_animation',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Animation type', 'dgc-wordpress-theme' ),
							'options'      => array(
								'fade'  => __( 'fade', 'dgc-wordpress-theme' ),
								'slide' => __( 'slide', 'dgc-wordpress-theme' )
							),
							'default'      => 'fade'
						),
						array(
							'id'           => 's_direction',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Sliding direction, "horizontal" or "vertical"', 'dgc-wordpress-theme' ),
							'options'      => array(
								'horizontal' => __( 'horizontal', 'dgc-wordpress-theme' ),
								'vertical'   => __( 'vertical', 'dgc-wordpress-theme' )
							),
							'default'      => 'horizontal'
						),
						array(
							'id'           => 's_reverse',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Reverse the animation direction', 'dgc-wordpress-theme' ),
							'options'      => array(
								'false' => __( 'false', 'dgc-wordpress-theme' ),
								'true'  => __( 'true', 'dgc-wordpress-theme' )
							),
							'default'      => 'false'
						),
						array(
							'id'           => 's_slideshow',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Animate slider automatically', 'dgc-wordpress-theme' ),
							'options'      => array(
								'true'  => __( 'true', 'dgc-wordpress-theme' ),
								'false' => __( 'false', 'dgc-wordpress-theme' )
							),
							'default'      => 'true'
						),
						array(
							'id'           => 's_slideshowSpeed',
							'type'         => 'text',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Set the speed of the slideshow cycling, in milliseconds',
								'dgc-wordpress-theme' ),
							'default'      => '7000'
						),
						array(
							'id'           => 's_animationSpeed',
							'type'         => 'text',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Set the speed of animations, in milliseconds', 'dgc-wordpress-theme' ),
							'default'      => '600'
						),
						array(
							'id'           => 's_initDelay',
							'type'         => 'text',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Set an initialization delay, in milliseconds', 'dgc-wordpress-theme' ),
							'default'      => '0'
						),
						array(
							'id'           => 's_randomize',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Randomize slide order', 'dgc-wordpress-theme' ),
							'options'      => array(
								'false' => __( 'false', 'dgc-wordpress-theme' ),
								'true'  => __( 'true', 'dgc-wordpress-theme' )
							),
							'default'      => 'false'
						),
						array(
							'id'           => 's_controlnav',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Manual control usage', 'dgc-wordpress-theme' ),
							'options'      => array(
								'true'  => __( 'true', 'dgc-wordpress-theme' ),
								'false' => __( 'false', 'dgc-wordpress-theme' )
							),
							'default'      => 'true'
						),
						array(
							'id'           => 's_touch',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Touch swipe', 'dgc-wordpress-theme' ),
							'options'      => array(
								'true'  => __( 'true', 'dgc-wordpress-theme' ),
								'false' => __( 'false', 'dgc-wordpress-theme' )
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_skins',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Slider Skins', 'dgc-wordpress-theme' ),
							'options'      => array(
								'theme-bar'     => __( 'bar', 'dgc-wordpress-theme' ),
								'theme-default' => __( 'default', 'dgc-wordpress-theme' ),
								'theme-dark'    => __( 'dark', 'dgc-wordpress-theme' ),
								'theme-light'   => __( 'light', 'dgc-wordpress-theme' )
							),
							'default'      => 'theme-bar'
						),
						array(
							'id'           => 'nv_animation',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Effect', 'dgc-wordpress-theme' ),
							'options'      => array(
								'random'                 => __( 'random', 'dgc-wordpress-theme' ),
								'sliceDownRight'         => __( 'sliceDownRight', 'dgc-wordpress-theme' ),
								'sliceDownLeft'          => __( 'sliceDownLeft', 'dgc-wordpress-theme' ),
								'sliceUpRight'           => __( 'sliceUpRight', 'dgc-wordpress-theme' ),
								'sliceUpDown'            => __( 'sliceUpDown', 'dgc-wordpress-theme' ),
								'sliceUpDownLeft'        => __( 'sliceUpDownLeft', 'dgc-wordpress-theme' ),
								'fold'                   => __( 'fold', 'dgc-wordpress-theme' ),
								'fade'                   => __( 'fade', 'dgc-wordpress-theme' ),
								'boxRandom'              => __( 'boxRandom', 'dgc-wordpress-theme' ),
								'boxRain'                => __( 'boxRain', 'dgc-wordpress-theme' ),
								'boxRainReverse'         => __( 'boxRainReverse', 'dgc-wordpress-theme' ),
								'boxRainGrow'            => __( 'boxRainGrow', 'dgc-wordpress-theme' ),
								'boxRainGrowReverse	' => __( 'boxRainGrowReverse', 'dgc-wordpress-theme' )
							),
							'default'      => 'random'
						),
						array(
							'id'           => 'nv_slice',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'For slice animations', 'dgc-wordpress-theme' ),
							'default'      => '15'
						),
						array(
							'id'           => 'nv_boxCols',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'For box animations (Cols)', 'dgc-wordpress-theme' ),
							'default'      => '8'
						),
						array(
							'id'           => 'nv_boxRows',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'For box animations (Rows)', 'dgc-wordpress-theme' ),
							'default'      => '4'
						),
						array(
							'id'           => 'nv_animSpeed',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Slide transition speed', 'dgc-wordpress-theme' ),
							'default'      => '500'
						),
						array(
							'id'           => 'nv_pauseTime',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'How long each slide will show', 'dgc-wordpress-theme' ),
							'default'      => '3000'
						),
						array(
							'id'           => 'nv_startSlide',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Set starting Slide (0 index)', 'dgc-wordpress-theme' ),
							'default'      => '0'
						),
						array(
							'id'           => 'nv_directionNav',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Next & Prev navigation', 'dgc-wordpress-theme' ),
							'options'      => array(
								'true'  => __( 'true', 'dgc-wordpress-theme' ),
								'false' => __( 'false', 'dgc-wordpress-theme' ),
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_controlNav',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( '1,2,3... navigation', 'dgc-wordpress-theme' ),
							'options'      => array(
								'true'  => __( 'true', 'dgc-wordpress-theme' ),
								'false' => __( 'false', 'dgc-wordpress-theme' ),
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_controlNavThumbs',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Use thumbnails for Control Nav', 'dgc-wordpress-theme' ),
							'options'      => array(
								'true'  => __( 'true', 'dgc-wordpress-theme' ),
								'false' => __( 'false', 'dgc-wordpress-theme' ),
							),
							'default'      => 'false'
						),
						array(
							'id'           => 'nv_pauseOnHover',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Stop animation while hovering', 'dgc-wordpress-theme' ),
							'options'      => array(
								'true'  => __( 'true', 'dgc-wordpress-theme' ),
								'false' => __( 'false', 'dgc-wordpress-theme' ),
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_manualAdvance',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Force manual transitions', 'dgc-wordpress-theme' ),
							'options'      => array(
								'true'  => __( 'true', 'dgc-wordpress-theme' ),
								'false' => __( 'false', 'dgc-wordpress-theme' ),
							),
							'default'      => 'false'
						),
						array(
							'id'           => 'nv_prevText',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Prev directionNav text', 'dgc-wordpress-theme' ),
							'default'      => __( 'Prev', 'dgc-wordpress-theme' )
						),
						array(
							'id'           => 'nv_nextText',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Next directionNav text', 'dgc-wordpress-theme' ),
							'default'      => __( 'Next', 'dgc-wordpress-theme' )
						),
						array(
							'id'           => 'nv_randomStart',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Start on a random slide', 'dgc-wordpress-theme' ),
							'options'      => array(
								'true'  => __( 'true', 'dgc-wordpress-theme' ),
								'false' => __( 'false', 'dgc-wordpress-theme' ),
							),
							'default'      => 'false'
						),
					)

				),
				array(
					'id'    => 'slides',
					'type'  => 'slides',
					'label' => __( 'Slides', 'dgc-wordpress-theme' ),
					'info'  => __( 'Add images to slider (Supported files .png, .jpg, .gif). If you want to change order, just drag and drop it. Image size for slides is original from media gallery, please upload images in same size, to get best display on page. To display slider in needed place use shortcode [dgc_slider]. Current theme version support only one slider per website.',
						'dgc-wordpress-theme' ),
				)
			)
		);

		/*Social Links*/
		$this->sections['social-links'] = array(
			'title'  => __( 'Social Links', 'dgc-wordpress-theme' ),
			'id'     => 'social-links',
			'fields' => array(
				array(
					'id'      => 'sl_position',
					'label'   => __( 'Socials Links Position', 'dgc-wordpress-theme' ),
					'info'    => __( 'Choose place where social links will be displayed.', 'dgc-wordpress-theme' ),
					'type'    => 'select',
					'options' => array( '0' => __( 'Footer', 'dgc-wordpress-theme' ), '1' => __( 'Header', 'dgc-wordpress-theme' ) ),
					'default' => '0'
				),
				array(
					'id'     => 'social-links',
					'label'  => __( 'Socials Links', 'dgc-wordpress-theme' ),
					'info'   => __( 'Add link to your social media profiles. Icons with link will be display in header or footer.',
						'dgc-wordpress-theme' ),
					'fields' => array(
						array(
							'id'        => 'facebook_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Facebook', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'twitter_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Twitter', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'linkedin_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'LinkedIn', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'myspace_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'MySpace', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'googleplus_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Google Plus+', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'dribbble_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Dribbble', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'skype_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Skype', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'flickr_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Flickr', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'youtube_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'You Tube', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'vimeo_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Vimeo', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'rss_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'RSS', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'vk_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Vk.com', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'instagram_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Instagram', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'pinterest_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Pinterest', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'yelp_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Yelp', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'email_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'E-mail', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'github_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Github', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'tumblr_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Tumblr', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'soundcloud_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Soundcloud', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'tripadvisor_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Tripadvisor', 'dgc-wordpress-theme' )
						),
						array(
							'id'        => 'ello_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Ello.co', 'dgc-wordpress-theme' )
						),
					)
				),
			)
		);

		/*Footer*/
		$this->sections['footer'] = array(
			'title'  => __( 'Footer', 'dgc-wordpress-theme' ),
			'id'     => 'footer',
			'fields' => array(
				array(
					'id'        => 'footer_text',
					'label'     => __( 'Footer options', 'dgc-wordpress-theme' ),
					'info'      => __( 'Replace default theme copyright information and links', 'dgc-wordpress-theme' ),
					'box-title' => __( 'Copyright section', 'dgc-wordpress-theme' ),
					'type'      => 'textarea',
					'default'   => __( 'dgc-network theme by <a href="https://github.com/dgc-network/">dgc-network</a> Powered by: <a href="http://wordpress.org">WordPress</a>',
						'dgc-wordpress-theme' ),
				)
			)
		);

		/*Custom CSS*/
		$this->sections['custom-css'] = array(
			'title'  => __( 'Custom CSS', 'dgc-wordpress-theme' ),
			'id'     => 'custom-css',
			'fields' => array(
				array(
					'id'        => 'custom_css',
					'label'     => __( 'Custom CSS', 'dgc-wordpress-theme' ),
					'info'      => __( 'Theme has two css files style.css and fixed-style.css which use default styles for front-end responsive and static layout. Do not edit theme default css files, use textarea editor below for overwriting all css styles.',
						'dgc-wordpress-theme' ),
					'box-title' => __( 'Styles editor', 'dgc-wordpress-theme' ),
					'type'      => 'textarea',
					'default'   => '',
				)
			)
		);

		/*Woocommerce*/
		if ( class_exists( 'Woocommerce' ) ) {
			$this->sections['woo'] = array(
				'title'  => __( 'Woocommerce', 'dgc-wordpress-theme' ),
				'id'     => 'woo',
				'fields' => array(
					array(
						'id'          => 'showcart',
						'label'       => __( 'Show cart in header', 'dgc-wordpress-theme' ),
						'info'        => __( 'If you want to display cart link in header select options below.',
							'dgc-wordpress-theme' ),
						'type'        => 'checkbox',
						'description' => __( 'Enable', 'dgc-wordpress-theme' ),
						'default'     => 'on',
					),
					array(
						'label'   => __( 'Cart color', 'dgc-wordpress-theme' ),
						'info'    => __( 'Choose color for cart icon', 'dgc-wordpress-theme' ),
						'id'      => 'cart_color',
						'type'    => 'color',
						'default' => '#020202',
					),
					array(
						'id'      => 'woo_shop_sidebar',
						'label'   => __( 'Woocommerce Shop Sidebar', 'dgc-wordpress-theme' ),
						'info'    => __( 'Show or hide sidebar', 'dgc-wordpress-theme' ),
						'type'    => 'select',
						'options' => array(
							'2' => __( 'Left sidebar', 'dgc-wordpress-theme' ),
							'1' => __( 'Full width', 'dgc-wordpress-theme' ),
							'3' => __( 'Right sidebar', 'dgc-wordpress-theme' )
						),
						'default' => '2',
					),
					array(
						'id'      => 'woo_product_sidebar',
						'label'   => __( 'Woocommerce Product Sidebar', 'dgc-wordpress-theme' ),
						'info'    => __( 'Show or hide sidebar', 'dgc-wordpress-theme' ),
						'type'    => 'select',
						'options' => array(
							'1' => __( 'Full width with tabs on right side', 'dgc-wordpress-theme' ),
							'2' => __( 'Left sidebar', 'dgc-wordpress-theme' ),
							'3' => __( 'Right sidebar', 'dgc-wordpress-theme' ),
							'4' => __( 'Full width with tabs on left side', 'dgc-wordpress-theme' ),
							'5' => __( 'Full width with tabs in center', 'dgc-wordpress-theme' )
						),
						'default' => '1',
					),
					array(
						'id'      => 'shop_num_row',
						'label'   => __( 'Woocommerce pages products per row', 'dgc-wordpress-theme' ),
						'info'    => __( 'Choose number of products', 'dgc-wordpress-theme' ),
						'type'    => 'select',
						'options' => array(
							'2' => __( '2 products', 'dgc-wordpress-theme' ),
							'3' => __( '3 products', 'dgc-wordpress-theme' ),
							'4' => __( '4 products', 'dgc-wordpress-theme' ),
							'5' => __( '5 products', 'dgc-wordpress-theme' )
						),
						'default' => '4',
					),
					array(
						'id'      => 'woo_shop_num_prod',
						'label'   => __( 'Number of products on Shop pages', 'dgc-wordpress-theme' ),
						'info'    => __( 'Choose number of products. Write -1 for show all products on one page',
							'dgc-wordpress-theme' ),
						'type'    => 'text',
						'default' => '10',
					),
				)
			);
		}

		$this->sections = apply_filters( 'settings_fields', $this->sections );

		return $this->sections;
	}

	public function setArguments() {
		$this->args = array(
			'opt_name'  => 'dgc_theme_options', // Database option
			'opt_group' => 'dgc_options',         // Options group
			'opt_slug'  => 'theme_options',          // Menu slug
		);
	}

	public function add_menu_item() {
		/*
		* Add our theme options page to the admin menu.
		* This function is attached to the admin_menu action hook.
		* @since dgc-network theme 1.0
		*/
		$admin_page = add_theme_page(
			__( 'Theme Options', 'dgc-wordpress-theme' ),                             // Name of page
			__( 'Theme Options', 'dgc-wordpress-theme' ),                             // Label in menu
			'edit_theme_options',                                     // Capability required
			$this->args['opt_slug'],                                 // Menu slug, used to uniquely identify the page
			array( &$this, 'dgc_theme_options_render_page' )    // Function that renders the options page
		);
		add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'settings_assets' ) );
	}

	public function dgc_add_custom_link_options() {
		global $wp_admin_bar, $wpdb;
		if ( ! is_super_admin() || ! is_admin_bar_showing() ) {
			return;
		}

		/* Add the main siteadmin menu item */
		$wp_admin_bar->add_menu( array(
			'id'    => 'dgctheme_options',
			'title' => __( 'Theme Options', 'dgc-wordpress-theme' ),
			'href'  => admin_url( 'admin.php?page=theme_options' )
		) );
	}

	public function settings_assets() {
		wp_print_scripts( 'jquery-ui-tabs' );
		dgc_add_jquery_script();
		dgc_add_admin_style();
	}

	public function display_field( $data = array(), $echo = true ) {
		$field       = $data;
		$option_name = $data = '';

		$id   = ( isset( $field['id'] ) ) ? $field['id'] : '';
		$type = ( isset( $field['type'] ) ) ? $field['type'] : '';

		$option_name = $id;
		$option      = dgc_get_theme_options();

		if ( isset( $option ) ) {
			$data = $option[ $option_name ];
		}

		if ( $data == null && isset( $field['default'] ) ) {
			$data = $field['default'];
		} elseif ( $data === null ) {
			$data = '';
		}
		$html = '';
		switch ( $type ) {
			case 'text':
				if ( ! empty( $field['box-title'] ) ) {
					$html .= '<h4>' . esc_attr( $field['box-title'] ) . '</h4>';
				}
				$html .= '<input class="text-input" id="' . esc_attr( $field['id'] ) . '" type="text" name="' . $this->args['opt_name'] . '[' . esc_attr( $field['id'] ) . ']" value="' . $data . '" />' . "\n";
				break;
			case 'textarea':
				if ( ! empty( $field['box-title'] ) ) {
					$html .= '<h4>' . esc_attr( $field['box-title'] ) . '</h4>';
				}
				$html .= '<textarea class="large-text" id="' . esc_attr( $field['id'] ) . '" rows="20" cols="50" name="' . $this->args['opt_name'] . '[' . esc_attr( $field['id'] ) . ']" >' . stripslashes( $data ) . '</textarea>' . "\n";
				break;
			case 'checkbox':
				if ( ! empty( $field['box-title'] ) ) {
					$html .= '<h4>' . esc_attr( $field['box-title'] ) . '</h4>';
				}
				$html .= '<label for="' . esc_attr( $field['id'] ) . '"><input type="checkbox" id="' . esc_attr( $field['id'] ) . '" name="' . $this->args['opt_name'] . '[' . esc_attr( $field['id'] ) . ']" ' . checked( 'on',
						$data, false ) . '/> ' . esc_attr( $field['description'] ) . '</label>';
				break;
			case 'select':
				$class = '';
				if ( ! empty( $field['box-title'] ) ) {
					$html .= '<h4>' . esc_attr( $field['box-title'] ) . '</h4>';
				}
				if ( ! empty( $field['class'] ) ) {
					$class = esc_attr( $field['class'] );
				}
				$html .= '<select class="' . $class . '" name="' . $this->args['opt_name'] . '[' . esc_attr( $field['id'] ) . ']" id="' . esc_attr( $field['id'] ) . '">';
				foreach ( $field['options'] as $k => $v ) {
					$selected = false;
					if ( $k == $data ) {
						$selected = true;
					}
					$html .= '<option ' . selected( $selected, true,
							false ) . ' value="' . esc_attr( $k ) . '">' . esc_attr( $v ) . '</option>';
				}
				$html .= '</select> ';
				break;
			case 'button':
				$html .= '<input class="' . esc_attr( $field['class'] ) . '" name="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['default'] ) . '" id="' . esc_attr( $field['id'] ) . '" />';
				break;
			case 'image':
				$html .= '<div class="box-image">';
				if ( $data != '' ) {
					$html             .= '<div class="img-container">';
					$image_attributes = wp_get_attachment_image_src( $data, 'full' );
					if ( ! empty( $image_attributes ) ) {
						$image_link = esc_url_raw( $image_attributes[0] );
					} else {
						$image_link = $data;
					}
					$html .= '<img src="' . $image_link . '" alt="" />';
					$html .= '</div>	';
				}

				$html       .= '<input class="of-input" name="' . $this->args['opt_name'] . '[' . esc_attr( $field['id'] ) . ']"   id="' . esc_attr( $field['id'] ) . '_upload" type="hidden" value="' . $data . '" />';
				$html       .= '<div class="upload_button_div">';
				$image_type = ( isset( $field['imagetype'] ) ) ? 'data-imagetype="' . $field['imagetype'] . '"' : '';
				$html       .= '<span ' . $image_type . ' class="button upload_btn" id="' . esc_attr( $field['id'] ) . '">' . __( 'Upload Image',
						'dgc-wordpress-theme' ) . '</span>';
				if ( ! empty( $data ) ) {
					$none = '';
				} else {
					$none = 'none';
				}
				$html .= '<span class="button reset_btn ' . $none . '" id="reset_' . esc_attr( $field['id'] ) . '" title="' . esc_attr( $field['id'] ) . '">' . __( 'Remove',
						'dgc-wordpress-theme' ) . '</span>';
				$html .= '</div>';
				$html .= '</div>';
				break;
			case 'color':
				if ( ! empty( $field['box-title'] ) ) {
					$html .= '<h4>' . esc_attr( $field['box-title'] ) . '</h4>';
				}
				$html .= '<input type="text" id="' . esc_attr( $field['id'] ) . '" class="colorPicker" name="' . $this->args['opt_name'] . '[' . esc_attr( $field['id'] ) . ']" value="' . esc_attr( $data ) . '" data-default-color="' . $field['default'] . '"/>';
				break;
			case 'font':
				$html .= '<div class="text_fonts">';
				$html .= '<div id="menu_sample_font" class="sample_text">' . __( 'Sample Font', 'dgc-wordpress-theme' ) . '</div>';
				$html .= '<select class="select-fonts" name="' . $this->args['opt_name'] . '[' . esc_attr( $field['id'] ) . ']" id="options-' . esc_attr( $field['id'] ) . '">';
				foreach ( $field['options'] as $k => $v ) {
					$selected = false;
					if ( $k == $data ) {
						$selected = true;
					}
					$html .= '<option ' . selected( $selected, true,
							false ) . ' value="' . esc_attr( $k ) . '">' . esc_attr( $v ) . '</option>';
				}
				$html .= '</select> ';
				$html .= '</div>';
				break;
			case 'slides':
				dgc_slider_images();
				break;
		}
		if ( ! $echo ) {
			return $html;
		}
		echo $html;
	}


	public function register_settings() {
		if ( is_array( $this->sections ) ) {
			foreach ( $this->sections as $section => $data ) {
				add_settings_section( $section, $data['title'], '__return_false', $this->args['opt_slug'] );
				foreach ( $data['fields'] as $field ) {
					$id    = ( isset( $field['id'] ) ) ? $field['id'] : '';
					$label = ( isset( $field['label'] ) ) ? $field['label'] : '';
					register_setting( $this->args['opt_group'], $this->args['opt_name'], '' );
					add_settings_field( $id, $label, array( $this, 'display_field' ), $this->args['opt_slug'], $section,
						$field );
				}
			}
		}
	}

	/**
	 * Renders the Theme Options administration screen.
	 *
	 * @since dgc-network theme 1.0
	 */
	public function dgc_theme_options_render_page() {
		?>
        <div class="wrap">
            <h2></h2>
            <form method="post" action="/" enctype="multipart/form-data" class="form-admin-dgc"
                  id="form-admin-dgc">
                <div id="save_options" class="save-options"></div>
                <div class="header">
                    <h2 class="title_theme"><?php _e( 'Theme Options', 'dgc-wordpress-theme' ); ?></h2>
					<?php submit_button( __( 'Save', 'dgc-wordpress-theme' ) ); ?>
					<?php settings_errors(); ?>
                </div>
                <div class="content">
                    <div class="menu-options">
                        <ul>
							<?php
							$idx = 0;
							$idm = 0;
							foreach ( $this->sections as $section => $data ) {
								echo '<li id="' . $section . '"><a  id="item_' . $idx ++ . '" href="javascript:void(0)"><span class="menu-img" id="menu_img_' . $idm ++ . '"></span><span class="menu-text">' . $data['title'] . '</a></li>';
							}
							?>

                        </ul>
                    </div>
					<?php
					settings_fields( $this->args['opt_group'] );
					dgc_custom_do_settings_sections( $this->args['opt_slug'] );
					?>

                </div>
                <div class="footer">
					<?php submit_button( __( 'Save', 'dgc-wordpress-theme' ) ); ?>
                </div>
                <input type="hidden" name="action" value="dgc_theme_options_action"/>
                <input type="hidden" name="security" value="<?php echo wp_create_nonce( 'dgc_theme_data' ); ?>"/>
            </form>

            <div id="sidebar-promo" class="sidebar-promo">
                <div class="sidebar-promo-widget promo-support">
                    <h3><?php _e( 'Support', 'dgc-wordpress-theme' ); ?></h3>
                    <p class="sidebar-promo-content"><?php
						_e( 'If You faced with problems or find error or bug, please', 'dgc-wordpress-theme' );
						echo ' <a target="_blank" href="http://dgc-network.zendesk.com/hc/en-us/requests/new">';
						_e( 'submit request.', 'dgc-wordpress-theme' );
						echo '</a> ';
						_e( 'On official ', 'dgc-wordpress-theme' );
						echo ' <a target="_blank" href="http://wordpress.org/support/theme/dgc">';
						_e( 'Support forum', 'dgc-wordpress-theme' );
						echo '</a> ';
						_e( 'You may find answers on Your questions.', 'dgc-wordpress-theme' );
						?></p>
                </div>
                <div class="sidebar-promo-widget promo-customization">
                    <h3><?php _e( 'Additional customization', 'dgc-wordpress-theme' ); ?></h3>
                    <p class="sidebar-promo-content"><?php
						_e( 'Our team is available for any type of WordPress development. ', 'dgc-wordpress-theme' );
						_e( 'If You want customize theme or add new features, You can', 'dgc-wordpress-theme' );
						echo ' ';
						_e( 'submit order', 'dgc-wordpress-theme' );
						echo ' ';
						_e( 'on our website', 'dgc-wordpress-theme' );
						?></p>
                </div>
                <div class="sidebar-promo-widget promo-about">
                    <h3><?php _e( 'dgc PRO', 'dgc-wordpress-theme' ); ?></h3>
                    <p class="sidebar-promo-content"><?php
						echo ' <a target="_blank" href="https://dgc-network.com/product/dgc-pro">';
						_e( 'dgc PRO - WordPress responsive theme', 'dgc-wordpress-theme' );
						echo '</a> ';
						_e( ' that contains all the options of ', 'dgc-wordpress-theme' );
						echo ' <a target="_blank" href="https://wordpress.org/themes/dgc/">';
						_e( 'FREE version', 'dgc-wordpress-theme' );
						echo '</a> ';
						_e( ' plus:', 'dgc-wordpress-theme' );
						?></p>
                    <ul class="sidebar-promo-list"><?php
						echo '<li><span>More options</span> like ability to change width for container grid.</li>';
						echo '<li><span>Priority</span> Support 24/7 with access to Help Center.</li>';
						echo '<li><span>Support</span> latest <a target="_blank" href="https://wordpress.org/plugins/woocommerce/">WooCommerce</a></li>';
						echo '<li><span>1 hour for customization</span> of your theme by our specialists.</li>';
						?></ul>
                </div>
            </div>
        </div>
		<?php
	}
}

global $dgc_theme_options;
$dgc_theme_options = new dgc_theme_options();