<?php
/**
 * dgc-wordpress-theme Theme Options
 *
 * @package dgc-wordpress-theme
 * @since dgc-wordpress-theme 1.0
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
 * @since dgc-wordpress-theme 1.0
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
			'title'  => __( 'General', 'taxonomy' ),
			'id'     => 'general',
			'fields' => array(
			array(
					'id'          => 'responsive',
					'label'       => __( 'Layout', 'taxonomy' ),
					'info'        => __( 'Theme supported 2 types of html layout. Default responsive setting which adapt for mobile devices and static page with fixed width. Uncheck arrow below if you need static website display',
						'taxonomy' ),
					'description' => __( 'Responsive', 'taxonomy' ),
					'type'        => 'checkbox',
					'default'     => 'on',
				),
				array(
					'id'     => 'pagecomment_ch',
					'label'  => __( 'Comments', 'taxonomy' ),
					'info'   => __( 'If you want to display comments on your post page or page, select options below.',
						'taxonomy' ),
					'fields' => array(
						array(
							'id'          => 'postcomment',
							'description' => __( 'Display comment on posts page', 'taxonomy' ),
							'type'        => 'checkbox',
							'default'     => 'on',
						),
						array(
							'id'          => 'pagecomment',
							'description' => __( 'Display comment on page', 'taxonomy' ),
							'type'        => 'checkbox',
							'default'     => 'on',
						),
					)
				),
				// array(
				// 'id' 			=> 'styletheme',
				// 'label'			=> __( 'Default theme styles' , 'taxonomy' ),
				// 'info'          => __( 'Default CSS. Theme option for styling is not working, if this option enable.', 'taxonomy' ),
				// 'description'	=> __( 'Enable', 'taxonomy' ),
				// 'type'			=> 'checkbox',
				// 'default'		=> 'off',
				// ),
				array(
					'id'      => 'latest_posts_templ',
					'label'   => __( 'Front page template with latest posts', 'taxonomy' ),
					'info'    => __( 'Settings > Reading > Front page displays > Your latest posts', 'taxonomy' ),
					'type'    => 'select',
					'options' => array(
						'0' => __( 'Full width', 'taxonomy' ),
						'1' => __( 'Right sidebar', 'taxonomy' ),
						'2' => __( 'Left sidebar', 'taxonomy' )
					),
					'default' => '0'
				),
				array(
					'label'  => __( 'Page templates by default', 'taxonomy' ),
					'info'   => __( 'Choose default display for templates.', 'taxonomy' ),
					'fields' => array(
						array(
							'id'        => 'layout_page_templ',
							'type'      => 'select',
							'box-title' => __( 'Page:', 'taxonomy' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'taxonomy' ),
								'0' => __( 'Full width', 'taxonomy' ),
								'2' => __( 'Left sidebar', 'taxonomy' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_single_templ',
							'type'      => 'select',
							'box-title' => __( 'Single Post:', 'taxonomy' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'taxonomy' ),
								'0' => __( 'Full width', 'taxonomy' ),
								'2' => __( 'Left sidebar', 'taxonomy' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_archive_templ',
							'type'      => 'select',
							'box-title' => __( 'Archive:', 'taxonomy' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'taxonomy' ),
								'0' => __( 'Full width', 'taxonomy' ),
								'2' => __( 'Left sidebar', 'taxonomy' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_author_templ',
							'type'      => 'select',
							'box-title' => __( 'Author:', 'taxonomy' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'taxonomy' ),
								'0' => __( 'Full width', 'taxonomy' ),
								'2' => __( 'Left sidebar', 'taxonomy' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_cat_templ',
							'type'      => 'select',
							'box-title' => __( 'Category:', 'taxonomy' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'taxonomy' ),
								'0' => __( 'Full width', 'taxonomy' ),
								'2' => __( 'Left sidebar', 'taxonomy' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_tag_templ',
							'type'      => 'select',
							'box-title' => __( 'Tags:', 'taxonomy' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'taxonomy' ),
								'0' => __( 'Full width', 'taxonomy' ),
								'2' => __( 'Left sidebar', 'taxonomy' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_404_templ',
							'type'      => 'select',
							'box-title' => __( '404:', 'taxonomy' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'taxonomy' ),
								'0' => __( 'Full width', 'taxonomy' ),
								'2' => __( 'Left sidebar', 'taxonomy' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_search_templ',
							'type'      => 'select',
							'box-title' => __( 'Search:', 'taxonomy' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'taxonomy' ),
								'0' => __( 'Full width', 'taxonomy' ),
								'2' => __( 'Left sidebar', 'taxonomy' )
							),
							'default'   => '1'
						),
					)
				),
				array(
					'id'          => 'show_featured_single',
					'label'       => __( 'Show Featured image on single post', 'taxonomy' ),
					'info'        => __( 'Select option below for show featured image on single post page.',
						'taxonomy' ),
					'description' => __( 'Show featured image', 'taxonomy' ),
					'type'        => 'checkbox',
					'default'     => 'on',
				),

				( ( function_exists( 'icl_get_languages' ) ) ?
					array(
						'id'          => 'is_wpml_ready',
						'type'        => 'checkbox',
						'label'       => __( 'Multilingual Switch in Header (WPML)', 'taxonomy' ),
						'info'        => __( 'If you wish to show Language Switch in header, select option below.',
							'taxonomy' ),
						'description' => __( 'Enable', 'taxonomy' ),
						'default'     => 'off'
					) :
					array(
						'id'      => 'reset',
						'label'   => __( 'Reset options', 'taxonomy' ),
						'info'    => __( 'All theme options will be reset to default.', 'taxonomy' ),
						'type'    => 'button',
						'default' => __( 'Reset Defaults', 'taxonomy' ),
						'class'   => 'button-primary reset-btn',
					)
				),
				array(
					'id'      => 'reset',
					'label'   => __( 'Reset options', 'taxonomy' ),
					'info'    => __( 'All theme options will be reset to default.', 'taxonomy' ),
					'type'    => 'button',
					'default' => __( 'Reset Defaults', 'taxonomy' ),
					'class'   => 'button-primary reset-btn',
				),
			)
		);


		/*Header*/

		$this->sections['header'] = array(
			'title'  => __( 'Header', 'taxonomy' ),
			'id'     => 'header',
			'fields' => array(
				array(
					'id'          => 'is_fixed_header',
					'label'       => __( 'Sticky  header', 'taxonomy' ),
					'info'        => __( 'Options relating to the website header', 'taxonomy' ),
					'description' => __( 'Enabled', 'taxonomy' ),
					'type'        => 'checkbox',
					'default'     => 'on',
				),
				array(
					'id'      => 'menu_position',
					'label'   => __( 'Menu Position', 'taxonomy' ),
					'info'    => __( 'Set menu position.', 'taxonomy' ),
					'type'    => 'select',
					'options' => array(
						'2' => __( 'Right', 'taxonomy' ),
						'0' => __( 'Left', 'taxonomy' ),
						'1' => __( 'Center', 'taxonomy' )
					),
					'default' => '2'
				),
				array(
					'id'      => 'menu_type_responsive',
					'label'   => __( 'Type of Responsive menu', 'taxonomy' ),
					'info'    => __( 'Set type of responsive menu.', 'taxonomy' ),
					'type'    => 'select',
					'options' => array(
						'inside_content' => __( 'Select menu', 'taxonomy' ),
						'full_width'     => __( 'Button menu', 'taxonomy' )
					),
					'default' => 'inside_content'
				),
				array(
					'id'      => 'menu_icon_color',
					'label'   => __( 'Menu icon color', 'taxonomy' ),
					'info'    => __( 'Chose color for collapsing menu icon', 'taxonomy' ),
					'type'    => 'color',
					'default' => '#333333',
				),
				array(
					'label'  => __( 'Background for header', 'taxonomy' ),
					'info'   => __( 'Upload image with full width for background in header area. (Supported files .png, .jpg, .gif)',
						'taxonomy' ),
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
							'box-title' => __( 'Header background-color', 'taxonomy' )
						)
					)
				),
				array(
					'id'      => 'header_img_size',
					'label'   => __( 'Background image size', 'taxonomy' ),
					'info'    => __( 'Choose size for background image - full width or only for content area.',
						'taxonomy' ),
					'type'    => 'select',
					'options' => array(
						'full'     => __( 'Full width position', 'taxonomy' ),
						'centered' => __( 'Centered position', 'taxonomy' )
					),
					'default' => 'full'
				),
				array(
					'id'      => 'header_height',
					'label'   => __( 'Height for header area', 'taxonomy' ),
					'info'    => __( 'Minimum height in pixels', 'taxonomy' ),
					'type'    => 'text',
					'default' => '80',
				),
			)
		);

		/*Background*/

		$this->sections['background'] = array(
			'title'  => __( 'Background', 'taxonomy' ),
			'id'     => 'background',
			'fields' => array(
				array(
					'label'  => __( 'Background Image', 'taxonomy' ),
					'info'   => __( 'Upload your background image for site background. (Supported files .png, .jpg, .gif)',
						'taxonomy' ),
					'fields' => array(
						array(
							'id'        => 'backgroung_img',
							'type'      => 'image',
							'imagetype' => 'headerbackground',
						),
						array(
							'id'          => 'bg_repeating',
							'description' => __( 'Background repeat', 'taxonomy' ),
							'type'        => 'checkbox',
							'default'     => 'off',
						),
					)
				),
				array(
					'id'      => 'background_color',
					'label'   => __( 'Background Color', 'taxonomy' ),
					'info'    => __( 'Choose color for body background', 'taxonomy' ),
					'type'    => 'color',
					'default' => '#ffffff'
				),
				array(
					'id'      => 'container_bg_color',
					'label'   => __( 'Background color for content', 'taxonomy' ),
					'info'    => __( 'Choose color for main content area', 'taxonomy' ),
					'type'    => 'color',
					'default' => '#ffffff'
				),
			)
		);

		/*Logo*/
		$this->sections['logo'] = array(
			'title'  => __( 'Logo', 'taxonomy' ),
			'id'     => 'logo',
			'fields' => array(
				array(
					'id'      => 'logo_position',
					'label'   => __( 'Logo Position', 'taxonomy' ),
					'info'    => __( 'Set Logo Position', 'taxonomy' ),
					'type'    => 'select',
					'options' => array(
						'0' => __( 'Left', 'taxonomy' ),
						'1' => __( 'Center', 'taxonomy' ),
						'2' => __( 'Right', 'taxonomy' )
					),
					'default' => '0'
				),
				array(
					'label'  => __( 'Logo size', 'taxonomy' ),
					'info'   => __( 'Specify resolution for your logo image', 'taxonomy' ),
					'fields' => array(
						array(
							'id'        => 'logo_w',
							'type'      => 'text',
							'default'   => '0',
							'box-title' => __( 'Width', 'taxonomy' )
						),
						array(
							'id'        => 'logo_h',
							'type'      => 'text',
							'default'   => '0',
							'box-title' => __( 'Height', 'taxonomy' )
						),
					)
				),
				array(
					'id'        => 'logo_img',
					'label'     => __( 'Logo image', 'taxonomy' ),
					'info'      => __( 'Upload logo image for your website. Size is original (Supported files .png, .jpg, .gif)',
						'taxonomy' ),
					'type'      => 'image',
					'imagetype' => 'logo',
				),
				array(
					'id'        => 'logo_img_retina',
					'label'     => __( 'Logo image retina', 'taxonomy' ),
					'info'      => __( 'Upload logo in double size (If your logo is 100 x 20px, it should be 200 x 40px)',
						'taxonomy' ),
					'type'      => 'image',
					'imagetype' => 'logo_retina',
				),
				array(
					'id'        => 'fav_icon',
					'label'     => __( 'Favicon', 'taxonomy' ),
					'info'      => __( 'A favicon is a 16x16 pixel icon that represents your site; upload your custom Favicon here.',
						'taxonomy' ),
					'type'      => 'image',
					'imagetype' => 'favicon',
				),
				array(
					'id'        => 'fav_icon_iphone',
					'label'     => __( 'Favicon iPhone', 'taxonomy' ),
					'info'      => __( 'Upload a custom favicon for iPhone (57x57 pixel png).', 'taxonomy' ),
					'type'      => 'image',
					'imagetype' => 'favicon_iphone',
				),
				array(
					'id'        => 'fav_icon_iphone_retina',
					'label'     => __( 'Favicon iPhone Retina', 'taxonomy' ),
					'info'      => __( 'Upload a custom favicon for iPhone retina (114x114 pixel png).', 'taxonomy' ),
					'type'      => 'image',
					'imagetype' => 'favicon_iphone_retina',
				),
				array(
					'id'        => 'fav_icon_ipad',
					'label'     => __( 'Favicon iPad', 'taxonomy' ),
					'info'      => __( 'Upload a custom favicon for iPad (72x72 pixel png).', 'taxonomy' ),
					'type'      => 'image',
					'imagetype' => 'favicon_ipad',
				),
				array(
					'id'        => 'fav_icon_ipad_retina',
					'label'     => __( 'Favicon iPad Retina', 'taxonomy' ),
					'info'      => __( 'Upload a custom favicon for iPhone retina (144x144 pixel png).', 'taxonomy' ),
					'type'      => 'image',
					'imagetype' => 'favicon_ipad_retina',
				),

			)
		);

		/*Colors*/
		$this->sections['colors'] = array(
			'title'  => __( 'Colors', 'taxonomy' ),
			'id'     => 'main-colors',
			'fields' => array(
				array(
					'id'     => 'menu-color',
					'label'  => __( 'Main menu color', 'taxonomy' ),
					'info'   => __( 'Choose your colors for main menu in header', 'taxonomy' ),
					'newrow' => true,
					'fields' => array(
						array(
							'id'        => 'menu_bg_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Background color', 'taxonomy' )
						),
						array(
							'id'        => 'menu_btn_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Menu button color', 'taxonomy' )
						),
						array(
							'id'        => 'menu_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Font color', 'taxonomy' )
						),
						array(
							'id'        => 'menu_hover_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Font color (active and hover)', 'taxonomy' )
						),
					)
				),
				array(
					'id'     => 'dd-menu-color',
					'label'  => __( 'Dropdown menu color', 'taxonomy' ),
					'info'   => __( 'Choose your colors for dropdown menu in header', 'taxonomy' ),
					'fields' => array(
						array(
							'id'        => 'dd_menu_bg_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Background color', 'taxonomy' )
						),
						array(
							'id'        => 'dd_menu_btn_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Menu button color', 'taxonomy' )
						),
						array(
							'id'        => 'dd_menu_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Font color', 'taxonomy' )
						),
						array(
							'id'        => 'dd_menu_hover_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Font color (active and hover)', 'taxonomy' )
						),
					)
				),
				array(
					'id'     => 'g-menu-color',
					'label'  => __( 'General font color', 'taxonomy' ),
					'info'   => __( 'Choose your colors for text and links', 'taxonomy' ),
					'newrow' => true,
					'fields' => array(
						array(
							'id'        => 'p_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Font color', 'taxonomy' )
						),
						array(
							'id'        => 'a_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Link color', 'taxonomy' )
						),
						array(
							'id'        => 'a_hover_font_color',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Link color (hover)', 'taxonomy' )
						),
						array(
							'id'        => 'a_focus_font_color',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Link color (focus)', 'taxonomy' )
						),
						array(
							'id'        => 'a_active_font_color',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Link color (active)', 'taxonomy' )
						),
					)
				),
				array(
					'id'     => 'lines-color',
					'label'  => __( 'Color for lines', 'taxonomy' ),
					'info'   => __( 'Choose your colors for lines and separators', 'taxonomy' ),
					'fields' => array(
						array(
							'id'        => 'widgets_sep_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Widget separator color', 'taxonomy' )
						),
						array(
							'id'        => 'date_of_post_b_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Blog post date color', 'taxonomy' )
						),
						array(
							'id'        => 'date_of_post_f_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Date font color', 'taxonomy' )
						),
					)
				),
				array(
					'id'     => 'buttons-color',
					'label'  => __( 'Color for buttons', 'taxonomy' ),
					'info'   => __( 'Choose your colors for buttons', 'taxonomy' ),
					'newrow' => true,
					'fields' => array(
						array(
							'id'        => 'btn_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Button background color', 'taxonomy' )
						),
						array(
							'id'        => 'btn_active_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Button background color (hover, active, focus, current page - pagenavi)',
								'taxonomy' )
						),
					)
				),
				array(
					'id'     => 'social-color',
					'label'  => __( 'Color for social icons', 'taxonomy' ),
					'info'   => __( 'Choose your colors for social icons', 'taxonomy' ),
					'fields' => array(
						array(
							'id'        => 'soc_icon_bg_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Social icons background color', 'taxonomy' )
						),
						array(
							'id'        => 'soc_icon_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Button background color (hover, active, focus, current page - pagenavi)',
								'taxonomy' )
						),
					)
				),
				array(
					'id'     => 'woocommerce-color',
					'label'  => __( 'WooCommerce colors', 'taxonomy' ),
					'info'   => __( 'Choose your colors for WooCommerce', 'taxonomy' ),
					'fields' => array(
						array(
							'id'        => 'woo_sale_price_color',
							'type'      => 'color',
							'default'   => '#919191',
							'box-title' => __( 'Sale price color', 'taxonomy' )
						),
						array(
							'id'        => 'woo_rating_color_regular',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Rating color (regular)', 'taxonomy' )
						),
						array(
							'id'        => 'woo_rating_color_active',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Rating color (hover, active)', 'taxonomy' )
						),
					)
				),
			)
		);

		/*Fonts*/
		$this->sections['fonts'] = array(
			'title'  => __( 'Fonts', 'taxonomy' ),
			'id'     => 'fonts',
			'fields' => array(
				// array(
				// 'label'			=> __( 'Fonts' , 'taxonomy' ),
				// 'info'			=> __( 'Popular web safe font collection, select and use for your needs.', 'taxonomy' ),
				// ),
				array(
					'id'      => 'h_font_family',
					'label'   => __( 'Headers', 'taxonomy' ),
					'info'    => __( 'Choose font-family for all headlines.', 'taxonomy' ),
					'type'    => 'font',
					'options' => dgc_fonts_list(),
					'default' => 'Open Sans, sans-serif',
				),
				array(
					'id'      => 'm_font_family',
					'label'   => __( 'Menu', 'taxonomy' ),
					'info'    => __( 'Choose font-family for primary menu.', 'taxonomy' ),
					'type'    => 'font',
					'options' => dgc_fonts_list(),
					'default' => 'Open Sans, sans-serif',
				),
				array(
					'id'      => 'p_font_family',
					'label'   => __( 'Body', 'taxonomy' ),
					'info'    => __( 'Choose font-family for content.', 'taxonomy' ),
					'type'    => 'font',
					'options' => dgc_fonts_list(),
					'default' => 'Open Sans, sans-serif',
				),
				array(
					'id'     => 'font-size',
					'label'  => __( 'Font size', 'taxonomy' ),
					'info'   => __( 'Choose font size for specific html elements. Set size as number, without px..',
						'taxonomy' ),
					'fields' => array(
						array(
							'id'        => 'h1_size',
							'type'      => 'text',
							'default'   => '27',
							'box-title' => __( 'H1', 'taxonomy' ),
						),
						array(
							'id'        => 'h2_size',
							'type'      => 'text',
							'default'   => '34',
							'box-title' => __( 'H2', 'taxonomy' ),
						),
						array(
							'id'        => 'h3_size',
							'type'      => 'text',
							'default'   => '18',
							'box-title' => __( 'H3', 'taxonomy' ),
						),
						array(
							'id'        => 'h4_size',
							'type'      => 'text',
							'default'   => '17',
							'box-title' => __( 'H4', 'taxonomy' ),
						),
						array(
							'id'        => 'h5_size',
							'type'      => 'text',
							'default'   => '14',
							'box-title' => __( 'H5', 'taxonomy' ),
						),
						array(
							'id'        => 'h6_size',
							'type'      => 'text',
							'default'   => '12',
							'box-title' => __( 'H6', 'taxonomy' ),
						),
						array(
							'id'        => 'm_size',
							'type'      => 'text',
							'default'   => '14',
							'box-title' => __( 'Menu', 'taxonomy' ),
						),
						array(
							'id'        => 'p_size',
							'type'      => 'text',
							'default'   => '14',
							'box-title' => __( 'P', 'taxonomy' ),
						),
					)
				)

			),
		);

		/*Slider*/
		$this->sections['slider'] = array(
			'title'  => __( 'Slider', 'taxonomy' ),
			'id'     => 'slider',
			'fields' => array(
				array(
					'id'      => 'select_slider',
					'class'   => 'select-slider',
					'label'   => __( 'Slider', 'taxonomy' ),
					'info'    => __( 'Select a slider type that will be used by default.', 'taxonomy' ),
					'type'    => 'select',
					'options' => array(
						'1' => __( 'FlexSlider', 'taxonomy' ),
						'2' => __( 'Nivo Slider', 'taxonomy' )
					),
					'default' => '1'
				),
				array(
					'id'     => 'slider-options',
					'label'  => __( 'Slider Options', 'taxonomy' ),
					'info'   => __( 'Choose needed options for slider: animation type, sliding direction, speed of animations, etc',
						'taxonomy' ),
					'type'   => 'slider-options',
					'fields' => array(
						array(
							'id'           => 's_animation',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Animation type', 'taxonomy' ),
							'options'      => array(
								'fade'  => __( 'fade', 'taxonomy' ),
								'slide' => __( 'slide', 'taxonomy' )
							),
							'default'      => 'fade'
						),
						array(
							'id'           => 's_direction',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Sliding direction, "horizontal" or "vertical"', 'taxonomy' ),
							'options'      => array(
								'horizontal' => __( 'horizontal', 'taxonomy' ),
								'vertical'   => __( 'vertical', 'taxonomy' )
							),
							'default'      => 'horizontal'
						),
						array(
							'id'           => 's_reverse',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Reverse the animation direction', 'taxonomy' ),
							'options'      => array(
								'false' => __( 'false', 'taxonomy' ),
								'true'  => __( 'true', 'taxonomy' )
							),
							'default'      => 'false'
						),
						array(
							'id'           => 's_slideshow',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Animate slider automatically', 'taxonomy' ),
							'options'      => array(
								'true'  => __( 'true', 'taxonomy' ),
								'false' => __( 'false', 'taxonomy' )
							),
							'default'      => 'true'
						),
						array(
							'id'           => 's_slideshowSpeed',
							'type'         => 'text',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Set the speed of the slideshow cycling, in milliseconds',
								'taxonomy' ),
							'default'      => '7000'
						),
						array(
							'id'           => 's_animationSpeed',
							'type'         => 'text',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Set the speed of animations, in milliseconds', 'taxonomy' ),
							'default'      => '600'
						),
						array(
							'id'           => 's_initDelay',
							'type'         => 'text',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Set an initialization delay, in milliseconds', 'taxonomy' ),
							'default'      => '0'
						),
						array(
							'id'           => 's_randomize',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Randomize slide order', 'taxonomy' ),
							'options'      => array(
								'false' => __( 'false', 'taxonomy' ),
								'true'  => __( 'true', 'taxonomy' )
							),
							'default'      => 'false'
						),
						array(
							'id'           => 's_controlnav',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Manual control usage', 'taxonomy' ),
							'options'      => array(
								'true'  => __( 'true', 'taxonomy' ),
								'false' => __( 'false', 'taxonomy' )
							),
							'default'      => 'true'
						),
						array(
							'id'           => 's_touch',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Touch swipe', 'taxonomy' ),
							'options'      => array(
								'true'  => __( 'true', 'taxonomy' ),
								'false' => __( 'false', 'taxonomy' )
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_skins',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Slider Skins', 'taxonomy' ),
							'options'      => array(
								'theme-bar'     => __( 'bar', 'taxonomy' ),
								'theme-default' => __( 'default', 'taxonomy' ),
								'theme-dark'    => __( 'dark', 'taxonomy' ),
								'theme-light'   => __( 'light', 'taxonomy' )
							),
							'default'      => 'theme-bar'
						),
						array(
							'id'           => 'nv_animation',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Effect', 'taxonomy' ),
							'options'      => array(
								'random'                 => __( 'random', 'taxonomy' ),
								'sliceDownRight'         => __( 'sliceDownRight', 'taxonomy' ),
								'sliceDownLeft'          => __( 'sliceDownLeft', 'taxonomy' ),
								'sliceUpRight'           => __( 'sliceUpRight', 'taxonomy' ),
								'sliceUpDown'            => __( 'sliceUpDown', 'taxonomy' ),
								'sliceUpDownLeft'        => __( 'sliceUpDownLeft', 'taxonomy' ),
								'fold'                   => __( 'fold', 'taxonomy' ),
								'fade'                   => __( 'fade', 'taxonomy' ),
								'boxRandom'              => __( 'boxRandom', 'taxonomy' ),
								'boxRain'                => __( 'boxRain', 'taxonomy' ),
								'boxRainReverse'         => __( 'boxRainReverse', 'taxonomy' ),
								'boxRainGrow'            => __( 'boxRainGrow', 'taxonomy' ),
								'boxRainGrowReverse	' => __( 'boxRainGrowReverse', 'taxonomy' )
							),
							'default'      => 'random'
						),
						array(
							'id'           => 'nv_slice',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'For slice animations', 'taxonomy' ),
							'default'      => '15'
						),
						array(
							'id'           => 'nv_boxCols',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'For box animations (Cols)', 'taxonomy' ),
							'default'      => '8'
						),
						array(
							'id'           => 'nv_boxRows',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'For box animations (Rows)', 'taxonomy' ),
							'default'      => '4'
						),
						array(
							'id'           => 'nv_animSpeed',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Slide transition speed', 'taxonomy' ),
							'default'      => '500'
						),
						array(
							'id'           => 'nv_pauseTime',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'How long each slide will show', 'taxonomy' ),
							'default'      => '3000'
						),
						array(
							'id'           => 'nv_startSlide',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Set starting Slide (0 index)', 'taxonomy' ),
							'default'      => '0'
						),
						array(
							'id'           => 'nv_directionNav',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Next & Prev navigation', 'taxonomy' ),
							'options'      => array(
								'true'  => __( 'true', 'taxonomy' ),
								'false' => __( 'false', 'taxonomy' ),
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_controlNav',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( '1,2,3... navigation', 'taxonomy' ),
							'options'      => array(
								'true'  => __( 'true', 'taxonomy' ),
								'false' => __( 'false', 'taxonomy' ),
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_controlNavThumbs',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Use thumbnails for Control Nav', 'taxonomy' ),
							'options'      => array(
								'true'  => __( 'true', 'taxonomy' ),
								'false' => __( 'false', 'taxonomy' ),
							),
							'default'      => 'false'
						),
						array(
							'id'           => 'nv_pauseOnHover',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Stop animation while hovering', 'taxonomy' ),
							'options'      => array(
								'true'  => __( 'true', 'taxonomy' ),
								'false' => __( 'false', 'taxonomy' ),
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_manualAdvance',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Force manual transitions', 'taxonomy' ),
							'options'      => array(
								'true'  => __( 'true', 'taxonomy' ),
								'false' => __( 'false', 'taxonomy' ),
							),
							'default'      => 'false'
						),
						array(
							'id'           => 'nv_prevText',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Prev directionNav text', 'taxonomy' ),
							'default'      => __( 'Prev', 'taxonomy' )
						),
						array(
							'id'           => 'nv_nextText',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Next directionNav text', 'taxonomy' ),
							'default'      => __( 'Next', 'taxonomy' )
						),
						array(
							'id'           => 'nv_randomStart',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Start on a random slide', 'taxonomy' ),
							'options'      => array(
								'true'  => __( 'true', 'taxonomy' ),
								'false' => __( 'false', 'taxonomy' ),
							),
							'default'      => 'false'
						),
					)

				),
				array(
					'id'    => 'slides',
					'type'  => 'slides',
					'label' => __( 'Slides', 'taxonomy' ),
					'info'  => __( 'Add images to slider (Supported files .png, .jpg, .gif). If you want to change order, just drag and drop it. Image size for slides is original from media gallery, please upload images in same size, to get best display on page. To display slider in needed place use shortcode [dgc_slider]. Current theme version support only one slider per website.',
						'taxonomy' ),
				)
			)
		);

		/*Social Links*/
		$this->sections['social-links'] = array(
			'title'  => __( 'Social Links', 'taxonomy' ),
			'id'     => 'social-links',
			'fields' => array(
				array(
					'id'      => 'sl_position',
					'label'   => __( 'Socials Links Position', 'taxonomy' ),
					'info'    => __( 'Choose place where social links will be displayed.', 'taxonomy' ),
					'type'    => 'select',
					'options' => array( '0' => __( 'Footer', 'taxonomy' ), '1' => __( 'Header', 'taxonomy' ) ),
					'default' => '0'
				),
				array(
					'id'     => 'social-links',
					'label'  => __( 'Socials Links', 'taxonomy' ),
					'info'   => __( 'Add link to your social media profiles. Icons with link will be display in header or footer.',
						'taxonomy' ),
					'fields' => array(
						array(
							'id'        => 'facebook_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Facebook', 'taxonomy' )
						),
						array(
							'id'        => 'twitter_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Twitter', 'taxonomy' )
						),
						array(
							'id'        => 'linkedin_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'LinkedIn', 'taxonomy' )
						),
						array(
							'id'        => 'myspace_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'MySpace', 'taxonomy' )
						),
						array(
							'id'        => 'googleplus_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Google Plus+', 'taxonomy' )
						),
						array(
							'id'        => 'dribbble_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Dribbble', 'taxonomy' )
						),
						array(
							'id'        => 'skype_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Skype', 'taxonomy' )
						),
						array(
							'id'        => 'flickr_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Flickr', 'taxonomy' )
						),
						array(
							'id'        => 'youtube_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'You Tube', 'taxonomy' )
						),
						array(
							'id'        => 'vimeo_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Vimeo', 'taxonomy' )
						),
						array(
							'id'        => 'rss_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'RSS', 'taxonomy' )
						),
						array(
							'id'        => 'vk_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Vk.com', 'taxonomy' )
						),
						array(
							'id'        => 'instagram_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Instagram', 'taxonomy' )
						),
						array(
							'id'        => 'pinterest_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Pinterest', 'taxonomy' )
						),
						array(
							'id'        => 'yelp_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Yelp', 'taxonomy' )
						),
						array(
							'id'        => 'email_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'E-mail', 'taxonomy' )
						),
						array(
							'id'        => 'github_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Github', 'taxonomy' )
						),
						array(
							'id'        => 'tumblr_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Tumblr', 'taxonomy' )
						),
						array(
							'id'        => 'soundcloud_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Soundcloud', 'taxonomy' )
						),
						array(
							'id'        => 'tripadvisor_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Tripadvisor', 'taxonomy' )
						),
						array(
							'id'        => 'ello_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Ello.co', 'taxonomy' )
						),
					)
				),
			)
		);

		/*Footer*/
		$this->sections['footer'] = array(
			'title'  => __( 'Footer', 'taxonomy' ),
			'id'     => 'footer',
			'fields' => array(
				array(
					'id'        => 'footer_text',
					'label'     => __( 'Footer options', 'taxonomy' ),
					'info'      => __( 'Replace default theme copyright information and links', 'taxonomy' ),
					'box-title' => __( 'Copyright section', 'taxonomy' ),
					'type'      => 'textarea',
					'default'   => __( 'Powered by: dgc-wordpress-theme by <a href="https://github.com/dgc-network/">dgc-network</a>',
						'taxonomy' ),
				)
			)
		);

		/*Custom CSS*/
		$this->sections['custom-css'] = array(
			'title'  => __( 'Custom CSS', 'taxonomy' ),
			'id'     => 'custom-css',
			'fields' => array(
				array(
					'id'        => 'custom_css',
					'label'     => __( 'Custom CSS', 'taxonomy' ),
					'info'      => __( 'Theme has two css files style.css and fixed-style.css which use default styles for front-end responsive and static layout. Do not edit theme default css files, use textarea editor below for overwriting all css styles.',
						'taxonomy' ),
					'box-title' => __( 'Styles editor', 'taxonomy' ),
					'type'      => 'textarea',
					'default'   => '',
				)
			)
		);

		/*Woocommerce*/
		if ( class_exists( 'Woocommerce' ) ) {
			$this->sections['woo'] = array(
				'title'  => __( 'Woocommerce', 'taxonomy' ),
				'id'     => 'woo',
				'fields' => array(
					array(
						'id'          => 'showuser',
						'label'       => __( 'Show user button in header', 'taxonomy' ),
						'info'        => __( 'If you want to display my-account link in header select options below.',
							'taxonomy' ),
						'type'        => 'checkbox',
						'description' => __( 'Enable', 'taxonomy' ),
						'default'     => 'on',
					),
					array(
						'label'   => __( 'User color', 'taxonomy' ),
						'info'    => __( 'Choose color for user icon', 'taxonomy' ),
						'id'      => 'user_color',
						'type'    => 'color',
						'default' => '#020202',
					),
					array(
						'id'          => 'showcart',
						'label'       => __( 'Show cart in header', 'taxonomy' ),
						'info'        => __( 'If you want to display cart link in header select options below.',
							'taxonomy' ),
						'type'        => 'checkbox',
						'description' => __( 'Enable', 'taxonomy' ),
						'default'     => 'on',
					),
					array(
						'label'   => __( 'Cart color', 'taxonomy' ),
						'info'    => __( 'Choose color for cart icon', 'taxonomy' ),
						'id'      => 'cart_color',
						'type'    => 'color',
						'default' => '#020202',
					),
					array(
						'id'      => 'woo_shop_sidebar',
						'label'   => __( 'Woocommerce Shop Sidebar', 'taxonomy' ),
						'info'    => __( 'Show or hide sidebar', 'taxonomy' ),
						'type'    => 'select',
						'options' => array(
							'2' => __( 'Left sidebar', 'taxonomy' ),
							'1' => __( 'Full width', 'taxonomy' ),
							'3' => __( 'Right sidebar', 'taxonomy' )
						),
						'default' => '2',
					),
					array(
						'id'      => 'woo_product_sidebar',
						'label'   => __( 'Woocommerce Product Sidebar', 'taxonomy' ),
						'info'    => __( 'Show or hide sidebar', 'taxonomy' ),
						'type'    => 'select',
						'options' => array(
							'1' => __( 'Full width with tabs on right side', 'taxonomy' ),
							'2' => __( 'Left sidebar', 'taxonomy' ),
							'3' => __( 'Right sidebar', 'taxonomy' ),
							'4' => __( 'Full width with tabs on left side', 'taxonomy' ),
							'5' => __( 'Full width with tabs in center', 'taxonomy' )
						),
						'default' => '1',
					),
					array(
						'id'      => 'shop_num_row',
						'label'   => __( 'Woocommerce pages products per row', 'taxonomy' ),
						'info'    => __( 'Choose number of products', 'taxonomy' ),
						'type'    => 'select',
						'options' => array(
							'2' => __( '2 products', 'taxonomy' ),
							'3' => __( '3 products', 'taxonomy' ),
							'4' => __( '4 products', 'taxonomy' ),
							'5' => __( '5 products', 'taxonomy' )
						),
						'default' => '4',
					),
					array(
						'id'      => 'woo_shop_num_prod',
						'label'   => __( 'Number of products on Shop pages', 'taxonomy' ),
						'info'    => __( 'Choose number of products. Write -1 for show all products on one page',
							'taxonomy' ),
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
		* @since dgc-wordpress-theme 1.0
		*/
		$admin_page = add_theme_page(
			__( 'Theme Options', 'taxonomy' ),                             // Name of page
			__( 'Theme Options', 'taxonomy' ),                             // Label in menu
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
			'id'    => 'dgc_theme_options',
			'title' => __( 'Theme Options', 'taxonomy' ),
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
						'taxonomy' ) . '</span>';
				if ( ! empty( $data ) ) {
					$none = '';
				} else {
					$none = 'none';
				}
				$html .= '<span class="button reset_btn ' . $none . '" id="reset_' . esc_attr( $field['id'] ) . '" title="' . esc_attr( $field['id'] ) . '">' . __( 'Remove',
						'taxonomy' ) . '</span>';
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
				$html .= '<div id="menu_sample_font" class="sample_text">' . __( 'Sample Font', 'taxonomy' ) . '</div>';
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
	 * @since dgc-wordpress-theme 1.0
	 */
	public function dgc_theme_options_render_page() {
		?>
        <div class="wrap">
            <h2></h2>
            <form method="post" action="/" enctype="multipart/form-data" class="form-admin-dgc"
                  id="form-admin-dgc">
                <div id="save_options" class="save-options"></div>
                <div class="header">
                    <h2 class="title_theme"><?php _e( 'Theme Options', 'taxonomy' ); ?></h2>
					<?php submit_button( __( 'Save', 'taxonomy' ) ); ?>
					<?php settings_errors(); ?>
                </div>
                <div class="content">
                    <div class="menu-options">
                        <ul>
							<?php
							$idx = 0;
							$idm = 0;
							foreach ( $this->sections as $section => $data ) {
								echo '<li id="' . $section . '"><a id="item_' . $idx ++ . '" href="javascript:void(0)"><span class="menu-img" id="menu_img_' . $idm ++ . '"></span><span class="menu-text">' . $data['title'] . '</a></li>';
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
					<?php submit_button( __( 'Save', 'taxonomy' ) ); ?>
                </div>
                <input type="hidden" name="action" value="dgc_theme_options_action"/>
                <input type="hidden" name="security" value="<?php echo wp_create_nonce( 'dgc_theme_data' ); ?>"/>
            </form>

            <div id="sidebar-promo" class="sidebar-promo">
                <div class="sidebar-promo-widget promo-support">
                    <h3><?php _e( 'Support', 'taxonomy' ); ?></h3>
                    <p class="sidebar-promo-content"><?php
						_e( 'If You faced with problems or find error or bug, please', 'taxonomy' );
						echo ' <a target="_blank" href="http://dgc.zendesk.com/hc/en-us/requests/new">';
						_e( 'submit request.', 'taxonomy' );
						echo '</a> ';
						_e( 'On official ', 'taxonomy' );
						echo ' <a target="_blank" href="http://wordpress.org/support/theme/dgc-wordpress-theme">';
						_e( 'Support forum', 'taxonomy' );
						echo '</a> ';
						_e( 'You may find answers on Your questions.', 'taxonomy' );
						?></p>
                </div>
                <div class="sidebar-promo-widget promo-customization">
                    <h3><?php _e( 'Additional customization', 'taxonomy' ); ?></h3>
                    <p class="sidebar-promo-content"><?php
						_e( 'Our team is available for any type of WordPress development. ', 'taxonomy' );
						_e( 'If You want customize theme or add new features, You can', 'taxonomy' );
						echo ' ';
						_e( 'submit order', 'taxonomy' );
						echo ' ';
						_e( 'on our website', 'taxonomy' );
						?></p>
                </div>
                <div class="sidebar-promo-widget promo-about">
                    <h3><?php _e( 'dgc-wordpress-theme', 'taxonomy' ); ?></h3>
                    <p class="sidebar-promo-content"><?php
						echo ' <a target="_blank" href="https://dgc.network/product/dgc-wordpress-theme">';
						_e( 'dgc-wordpress-theme - WordPress responsive theme', 'taxonomy' );
						echo '</a> ';
						_e( ' that contains all the options of ', 'taxonomy' );
						echo ' <a target="_blank" href="https://wordpress.org/themes/dgc-wordpress-theme/">';
						_e( 'FREE version', 'taxonomy' );
						echo '</a> ';
						_e( ' plus:', 'taxonomy' );
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