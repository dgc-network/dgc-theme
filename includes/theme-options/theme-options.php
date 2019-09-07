<?php
/**
 * dgc-theme Theme Options
 *
 * @package dgc-theme
 * @since dgc-theme 1.0
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
 * @since dgc-theme 1.0
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
			'title'  => __( 'General', 'textdomain' ),
			'id'     => 'general',
			'fields' => array(
			array(
					'id'          => 'responsive',
					'label'       => __( 'Layout', 'textdomain' ),
					'info'        => __( 'Theme supported 2 types of html layout. Default responsive setting which adapt for mobile devices and static page with fixed width. Uncheck arrow below if you need static website display', 'textdomain' ),
					'description' => __( 'Responsive', 'textdomain' ),
					'type'        => 'checkbox',
					'default'     => 'on',
				),
				array(
					'id'     => 'pagecomment_ch',
					'label'  => __( 'Comments', 'textdomain' ),
					'info'   => __( 'If you want to display comments on your post page or page, select options below.', 'textdomain' ),
					'fields' => array(
						array(
							'id'          => 'postcomment',
							'description' => __( 'Display comment on posts page', 'textdomain' ),
							'type'        => 'checkbox',
							'default'     => 'on',
						),
						array(
							'id'          => 'pagecomment',
							'description' => __( 'Display comment on page', 'textdomain' ),
							'type'        => 'checkbox',
							'default'     => 'on',
						),
					)
				),
				// array(
				// 'id' 			=> 'styletheme',
				// 'label'			=> __( 'Default theme styles' , 'textdomain' ),
				// 'info'          => __( 'Default CSS. Theme option for styling is not working, if this option enable.', 'textdomain' ),
				// 'description'	=> __( 'Enable', 'textdomain' ),
				// 'type'			=> 'checkbox',
				// 'default'		=> 'off',
				// ),
				array(
					'id'      => 'latest_posts_templ',
					'label'   => __( 'Front page template with latest posts', 'textdomain' ),
					'info'    => __( 'Settings > Reading > Front page displays > Your latest posts', 'textdomain' ),
					'type'    => 'select',
					'options' => array(
						'0' => __( 'Full width', 'textdomain' ),
						'1' => __( 'Right sidebar', 'textdomain' ),
						'2' => __( 'Left sidebar', 'textdomain' )
					),
					'default' => '0'
				),
				array(
					'label'  => __( 'Page templates by default', 'textdomain' ),
					'info'   => __( 'Choose default display for templates.', 'textdomain' ),
					'fields' => array(
						array(
							'id'        => 'layout_page_templ',
							'type'      => 'select',
							'box-title' => __( 'Page:', 'textdomain' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'textdomain' ),
								'0' => __( 'Full width', 'textdomain' ),
								'2' => __( 'Left sidebar', 'textdomain' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_single_templ',
							'type'      => 'select',
							'box-title' => __( 'Single Post:', 'textdomain' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'textdomain' ),
								'0' => __( 'Full width', 'textdomain' ),
								'2' => __( 'Left sidebar', 'textdomain' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_archive_templ',
							'type'      => 'select',
							'box-title' => __( 'Archive:', 'textdomain' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'textdomain' ),
								'0' => __( 'Full width', 'textdomain' ),
								'2' => __( 'Left sidebar', 'textdomain' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_author_templ',
							'type'      => 'select',
							'box-title' => __( 'Author:', 'textdomain' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'textdomain' ),
								'0' => __( 'Full width', 'textdomain' ),
								'2' => __( 'Left sidebar', 'textdomain' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_cat_templ',
							'type'      => 'select',
							'box-title' => __( 'Category:', 'textdomain' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'textdomain' ),
								'0' => __( 'Full width', 'textdomain' ),
								'2' => __( 'Left sidebar', 'textdomain' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_tag_templ',
							'type'      => 'select',
							'box-title' => __( 'Tags:', 'textdomain' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'textdomain' ),
								'0' => __( 'Full width', 'textdomain' ),
								'2' => __( 'Left sidebar', 'textdomain' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_404_templ',
							'type'      => 'select',
							'box-title' => __( '404:', 'textdomain' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'textdomain' ),
								'0' => __( 'Full width', 'textdomain' ),
								'2' => __( 'Left sidebar', 'textdomain' )
							),
							'default'   => '1'
						),
						array(
							'id'        => 'layout_search_templ',
							'type'      => 'select',
							'box-title' => __( 'Search:', 'textdomain' ),
							'options'   => array(
								'1' => __( 'Right sidebar', 'textdomain' ),
								'0' => __( 'Full width', 'textdomain' ),
								'2' => __( 'Left sidebar', 'textdomain' )
							),
							'default'   => '1'
						),
					)
				),
				array(
					'id'          => 'show_featured_single',
					'label'       => __( 'Show Featured image on single post', 'textdomain' ),
					'info'        => __( 'Select option below for show featured image on single post page.', 'textdomain' ),
					'description' => __( 'Show featured image', 'textdomain' ),
					'type'        => 'checkbox',
					'default'     => 'on',
				),

				( ( function_exists( 'icl_get_languages' ) ) ?
					array(
						'id'          => 'is_wpml_ready',
						'type'        => 'checkbox',
						'label'       => __( 'Multilingual Switch in Header (WPML)', 'textdomain' ),
						'info'        => __( 'If you wish to show Language Switch in header, select option below.', 'textdomain' ),
						'description' => __( 'Enable', 'textdomain' ),
						'default'     => 'off'
					) :
					array(
						'id'      => 'reset',
						'label'   => __( 'Reset options', 'textdomain' ),
						'info'    => __( 'All theme options will be reset to default.', 'textdomain' ),
						'type'    => 'button',
						'default' => __( 'Reset Defaults', 'textdomain' ),
						'class'   => 'button-primary reset-btn',
					)
				),
				array(
					'id'      => 'reset',
					'label'   => __( 'Reset options', 'textdomain' ),
					'info'    => __( 'All theme options will be reset to default.', 'textdomain' ),
					'type'    => 'button',
					'default' => __( 'Reset Defaults', 'textdomain' ),
					'class'   => 'button-primary reset-btn',
				),
			)
		);


		/*Header*/

		$this->sections['header'] = array(
			'title'  => __( 'Header', 'textdomain' ),
			'id'     => 'header',
			'fields' => array(
				array(
					'id'          => 'is_fixed_header',
					'label'       => __( 'Sticky  header', 'textdomain' ),
					'info'        => __( 'Options relating to the website header', 'textdomain' ),
					'description' => __( 'Enabled', 'textdomain' ),
					'type'        => 'checkbox',
					'default'     => 'on',
				),
				array(
					'id'      => 'menu_position',
					'label'   => __( 'Menu Position', 'textdomain' ),
					'info'    => __( 'Set menu position.', 'textdomain' ),
					'type'    => 'select',
					'options' => array(
						'2' => __( 'Right', 'textdomain' ),
						'0' => __( 'Left', 'textdomain' ),
						'1' => __( 'Center', 'textdomain' )
					),
					'default' => '2'
				),
				array(
					'id'      => 'menu_type_responsive',
					'label'   => __( 'Type of Responsive menu', 'textdomain' ),
					'info'    => __( 'Set type of responsive menu.', 'textdomain' ),
					'type'    => 'select',
					'options' => array(
						'inside_content' => __( 'Select menu', 'textdomain' ),
						'full_width'     => __( 'Button menu', 'textdomain' )
					),
					'default' => 'inside_content'
				),
				array(
					'id'      => 'menu_icon_color',
					'label'   => __( 'Menu icon color', 'textdomain' ),
					'info'    => __( 'Chose color for collapsing menu icon', 'textdomain' ),
					'type'    => 'color',
					'default' => '#333333',
				),
				array(
					'label'  => __( 'Background for header', 'textdomain' ),
					'info'   => __( 'Upload image with full width for background in header area. (Supported files .png, .jpg, .gif)', 'textdomain' ),
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
							'box-title' => __( 'Header background-color', 'textdomain' )
						)
					)
				),
				array(
					'id'      => 'header_img_size',
					'label'   => __( 'Background image size', 'textdomain' ),
					'info'    => __( 'Choose size for background image - full width or only for content area.', 'textdomain' ),
					'type'    => 'select',
					'options' => array(
						'full'     => __( 'Full width position', 'textdomain' ),
						'centered' => __( 'Centered position', 'textdomain' )
					),
					'default' => 'full'
				),
				array(
					'id'      => 'header_height',
					'label'   => __( 'Height for header area', 'textdomain' ),
					'info'    => __( 'Minimum height in pixels', 'textdomain' ),
					'type'    => 'text',
					'default' => '80',
				),
			)
		);

		/*Background*/

		$this->sections['background'] = array(
			'title'  => __( 'Background', 'textdomain' ),
			'id'     => 'background',
			'fields' => array(
				array(
					'label'  => __( 'Background Image', 'textdomain' ),
					'info'   => __( 'Upload your background image for site background. (Supported files .png, .jpg, .gif)', 'textdomain' ),
					'fields' => array(
						array(
							'id'        => 'backgroung_img',
							'type'      => 'image',
							'imagetype' => 'headerbackground',
						),
						array(
							'id'          => 'bg_repeating',
							'description' => __( 'Background repeat', 'textdomain' ),
							'type'        => 'checkbox',
							'default'     => 'off',
						),
					)
				),
				array(
					'id'      => 'background_color',
					'label'   => __( 'Background Color', 'textdomain' ),
					'info'    => __( 'Choose color for body background', 'textdomain' ),
					'type'    => 'color',
					'default' => '#ffffff'
				),
				array(
					'id'      => 'container_bg_color',
					'label'   => __( 'Background color for content', 'textdomain' ),
					'info'    => __( 'Choose color for main content area', 'textdomain' ),
					'type'    => 'color',
					'default' => '#ffffff'
				),
			)
		);

		/*Logo*/
		$this->sections['logo'] = array(
			'title'  => __( 'Logo', 'textdomain' ),
			'id'     => 'logo',
			'fields' => array(
				array(
					'id'      => 'logo_position',
					'label'   => __( 'Logo Position', 'textdomain' ),
					'info'    => __( 'Set Logo Position', 'textdomain' ),
					'type'    => 'select',
					'options' => array(
						'0' => __( 'Left', 'textdomain' ),
						'1' => __( 'Center', 'textdomain' ),
						'2' => __( 'Right', 'textdomain' )
					),
					'default' => '0'
				),
				array(
					'label'  => __( 'Logo size', 'textdomain' ),
					'info'   => __( 'Specify resolution for your logo image', 'textdomain' ),
					'fields' => array(
						array(
							'id'        => 'logo_w',
							'type'      => 'text',
							'default'   => '0',
							'box-title' => __( 'Width', 'textdomain' )
						),
						array(
							'id'        => 'logo_h',
							'type'      => 'text',
							'default'   => '0',
							'box-title' => __( 'Height', 'textdomain' )
						),
					)
				),
				array(
					'id'        => 'logo_img',
					'label'     => __( 'Logo image', 'textdomain' ),
					'info'      => __( 'Upload logo image for your website. Size is original (Supported files .png, .jpg, .gif)', 'textdomain' ),
					'type'      => 'image',
					'imagetype' => 'logo',
				),
				array(
					'id'        => 'logo_img_retina',
					'label'     => __( 'Logo image retina', 'textdomain' ),
					'info'      => __( 'Upload logo in double size (If your logo is 100 x 20px, it should be 200 x 40px)', 'textdomain' ),
					'type'      => 'image',
					'imagetype' => 'logo_retina',
				),
				array(
					'id'        => 'fav_icon',
					'label'     => __( 'Favicon', 'textdomain' ),
					'info'      => __( 'A favicon is a 16x16 pixel icon that represents your site; upload your custom Favicon here.', 'textdomain' ),
					'type'      => 'image',
					'imagetype' => 'favicon',
				),
				array(
					'id'        => 'fav_icon_iphone',
					'label'     => __( 'Favicon iPhone', 'textdomain' ),
					'info'      => __( 'Upload a custom favicon for iPhone (57x57 pixel png).', 'textdomain' ),
					'type'      => 'image',
					'imagetype' => 'favicon_iphone',
				),
				array(
					'id'        => 'fav_icon_iphone_retina',
					'label'     => __( 'Favicon iPhone Retina', 'textdomain' ),
					'info'      => __( 'Upload a custom favicon for iPhone retina (114x114 pixel png).', 'textdomain' ),
					'type'      => 'image',
					'imagetype' => 'favicon_iphone_retina',
				),
				array(
					'id'        => 'fav_icon_ipad',
					'label'     => __( 'Favicon iPad', 'textdomain' ),
					'info'      => __( 'Upload a custom favicon for iPad (72x72 pixel png).', 'textdomain' ),
					'type'      => 'image',
					'imagetype' => 'favicon_ipad',
				),
				array(
					'id'        => 'fav_icon_ipad_retina',
					'label'     => __( 'Favicon iPad Retina', 'textdomain' ),
					'info'      => __( 'Upload a custom favicon for iPhone retina (144x144 pixel png).', 'textdomain' ),
					'type'      => 'image',
					'imagetype' => 'favicon_ipad_retina',
				),

			)
		);

		/*Colors*/
		$this->sections['colors'] = array(
			'title'  => __( 'Colors', 'textdomain' ),
			'id'     => 'main-colors',
			'fields' => array(
				array(
					'id'     => 'menu-color',
					'label'  => __( 'Main menu color', 'textdomain' ),
					'info'   => __( 'Choose your colors for main menu in header', 'textdomain' ),
					'newrow' => true,
					'fields' => array(
						array(
							'id'        => 'menu_bg_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Background color', 'textdomain' )
						),
						array(
							'id'        => 'menu_btn_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Menu button color', 'textdomain' )
						),
						array(
							'id'        => 'menu_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Font color', 'textdomain' )
						),
						array(
							'id'        => 'menu_hover_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Font color (active and hover)', 'textdomain' )
						),
					)
				),
				array(
					'id'     => 'dd-menu-color',
					'label'  => __( 'Dropdown menu color', 'textdomain' ),
					'info'   => __( 'Choose your colors for dropdown menu in header', 'textdomain' ),
					'fields' => array(
						array(
							'id'        => 'dd_menu_bg_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Background color', 'textdomain' )
						),
						array(
							'id'        => 'dd_menu_btn_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Menu button color', 'textdomain' )
						),
						array(
							'id'        => 'dd_menu_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Font color', 'textdomain' )
						),
						array(
							'id'        => 'dd_menu_hover_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Font color (active and hover)', 'textdomain' )
						),
					)
				),
				array(
					'id'     => 'g-menu-color',
					'label'  => __( 'General font color', 'textdomain' ),
					'info'   => __( 'Choose your colors for text and links', 'textdomain' ),
					'newrow' => true,
					'fields' => array(
						array(
							'id'        => 'p_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Font color', 'textdomain' )
						),
						array(
							'id'        => 'a_font_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Link color', 'textdomain' )
						),
						array(
							'id'        => 'a_hover_font_color',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Link color (hover)', 'textdomain' )
						),
						array(
							'id'        => 'a_focus_font_color',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Link color (focus)', 'textdomain' )
						),
						array(
							'id'        => 'a_active_font_color',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Link color (active)', 'textdomain' )
						),
					)
				),
				array(
					'id'     => 'lines-color',
					'label'  => __( 'Color for lines', 'textdomain' ),
					'info'   => __( 'Choose your colors for lines and separators', 'textdomain' ),
					'fields' => array(
						array(
							'id'        => 'widgets_sep_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Widget separator color', 'textdomain' )
						),
						array(
							'id'        => 'date_of_post_b_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Blog post date color', 'textdomain' )
						),
						array(
							'id'        => 'date_of_post_f_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Date font color', 'textdomain' )
						),
					)
				),
				array(
					'id'     => 'buttons-color',
					'label'  => __( 'Color for buttons', 'textdomain' ),
					'info'   => __( 'Choose your colors for buttons', 'textdomain' ),
					'newrow' => true,
					'fields' => array(
						array(
							'id'        => 'btn_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Button background color', 'textdomain' )
						),
						array(
							'id'        => 'btn_active_color',
							'type'      => 'color',
							'default'   => '#F15A23',
							'box-title' => __( 'Button background color (hover, active, focus, current page - pagenavi)', 'textdomain' )
						),
					)
				),
				array(
					'id'     => 'social-color',
					'label'  => __( 'Color for social icons', 'textdomain' ),
					'info'   => __( 'Choose your colors for social icons', 'textdomain' ),
					'fields' => array(
						array(
							'id'        => 'soc_icon_bg_color',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Social icons background color', 'textdomain' )
						),
						array(
							'id'        => 'soc_icon_color',
							'type'      => 'color',
							'default'   => '#ffffff',
							'box-title' => __( 'Button background color (hover, active, focus, current page - pagenavi)', 'textdomain' )
						),
					)
				),
				array(
					'id'     => 'woocommerce-color',
					'label'  => __( 'WooCommerce colors', 'textdomain' ),
					'info'   => __( 'Choose your colors for WooCommerce', 'textdomain' ),
					'fields' => array(
						array(
							'id'        => 'woo_sale_price_color',
							'type'      => 'color',
							'default'   => '#919191',
							'box-title' => __( 'Sale price color', 'textdomain' )
						),
						array(
							'id'        => 'woo_rating_color_regular',
							'type'      => 'color',
							'default'   => '#333333',
							'box-title' => __( 'Rating color (regular)', 'textdomain' )
						),
						array(
							'id'        => 'woo_rating_color_active',
							'type'      => 'color',
							'default'   => '#FF5D2A',
							'box-title' => __( 'Rating color (hover, active)', 'textdomain' )
						),
					)
				),
			)
		);

		/*Fonts*/
		$this->sections['fonts'] = array(
			'title'  => __( 'Fonts', 'textdomain' ),
			'id'     => 'fonts',
			'fields' => array(
				// array(
				// 'label'			=> __( 'Fonts' , 'textdomain' ),
				// 'info'			=> __( 'Popular web safe font collection, select and use for your needs.', 'textdomain' ),
				// ),
				array(
					'id'      => 'h_font_family',
					'label'   => __( 'Headers', 'textdomain' ),
					'info'    => __( 'Choose font-family for all headlines.', 'textdomain' ),
					'type'    => 'font',
					'options' => dgc_fonts_list(),
					'default' => 'Open Sans, sans-serif',
				),
				array(
					'id'      => 'm_font_family',
					'label'   => __( 'Menu', 'textdomain' ),
					'info'    => __( 'Choose font-family for primary menu.', 'textdomain' ),
					'type'    => 'font',
					'options' => dgc_fonts_list(),
					'default' => 'Open Sans, sans-serif',
				),
				array(
					'id'      => 'p_font_family',
					'label'   => __( 'Body', 'textdomain' ),
					'info'    => __( 'Choose font-family for content.', 'textdomain' ),
					'type'    => 'font',
					'options' => dgc_fonts_list(),
					'default' => 'Open Sans, sans-serif',
				),
				array(
					'id'     => 'font-size',
					'label'  => __( 'Font size', 'textdomain' ),
					'info'   => __( 'Choose font size for specific html elements. Set size as number, without px..', 'textdomain' ),
					'fields' => array(
						array(
							'id'        => 'h1_size',
							'type'      => 'text',
							'default'   => '27',
							'box-title' => __( 'H1', 'textdomain' ),
						),
						array(
							'id'        => 'h2_size',
							'type'      => 'text',
							'default'   => '34',
							'box-title' => __( 'H2', 'textdomain' ),
						),
						array(
							'id'        => 'h3_size',
							'type'      => 'text',
							'default'   => '18',
							'box-title' => __( 'H3', 'textdomain' ),
						),
						array(
							'id'        => 'h4_size',
							'type'      => 'text',
							'default'   => '17',
							'box-title' => __( 'H4', 'textdomain' ),
						),
						array(
							'id'        => 'h5_size',
							'type'      => 'text',
							'default'   => '14',
							'box-title' => __( 'H5', 'textdomain' ),
						),
						array(
							'id'        => 'h6_size',
							'type'      => 'text',
							'default'   => '12',
							'box-title' => __( 'H6', 'textdomain' ),
						),
						array(
							'id'        => 'm_size',
							'type'      => 'text',
							'default'   => '14',
							'box-title' => __( 'Menu', 'textdomain' ),
						),
						array(
							'id'        => 'p_size',
							'type'      => 'text',
							'default'   => '14',
							'box-title' => __( 'P', 'textdomain' ),
						),
					)
				)

			),
		);

		/*Slider*/
		$this->sections['slider'] = array(
			'title'  => __( 'Slider', 'textdomain' ),
			'id'     => 'slider',
			'fields' => array(
				array(
					'id'      => 'select_slider',
					'class'   => 'select-slider',
					'label'   => __( 'Slider', 'textdomain' ),
					'info'    => __( 'Select a slider type that will be used by default.', 'textdomain' ),
					'type'    => 'select',
					'options' => array(
						'1' => __( 'FlexSlider', 'textdomain' ),
						'2' => __( 'Nivo Slider', 'textdomain' )
					),
					'default' => '1'
				),
				array(
					'id'     => 'slider-options',
					'label'  => __( 'Slider Options', 'textdomain' ),
					'info'   => __( 'Choose needed options for slider: animation type, sliding direction, speed of animations, etc', 'textdomain' ),
					'type'   => 'slider-options',
					'fields' => array(
						array(
							'id'           => 's_animation',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Animation type', 'textdomain' ),
							'options'      => array(
								'fade'  => __( 'fade', 'textdomain' ),
								'slide' => __( 'slide', 'textdomain' )
							),
							'default'      => 'fade'
						),
						array(
							'id'           => 's_direction',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Sliding direction, "horizontal" or "vertical"', 'textdomain' ),
							'options'      => array(
								'horizontal' => __( 'horizontal', 'textdomain' ),
								'vertical'   => __( 'vertical', 'textdomain' )
							),
							'default'      => 'horizontal'
						),
						array(
							'id'           => 's_reverse',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Reverse the animation direction', 'textdomain' ),
							'options'      => array(
								'false' => __( 'false', 'textdomain' ),
								'true'  => __( 'true', 'textdomain' )
							),
							'default'      => 'false'
						),
						array(
							'id'           => 's_slideshow',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Animate slider automatically', 'textdomain' ),
							'options'      => array(
								'true'  => __( 'true', 'textdomain' ),
								'false' => __( 'false', 'textdomain' )
							),
							'default'      => 'true'
						),
						array(
							'id'           => 's_slideshowSpeed',
							'type'         => 'text',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Set the speed of the slideshow cycling, in milliseconds',
								'textdomain' ),
							'default'      => '7000'
						),
						array(
							'id'           => 's_animationSpeed',
							'type'         => 'text',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Set the speed of animations, in milliseconds', 'textdomain' ),
							'default'      => '600'
						),
						array(
							'id'           => 's_initDelay',
							'type'         => 'text',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Set an initialization delay, in milliseconds', 'textdomain' ),
							'default'      => '0'
						),
						array(
							'id'           => 's_randomize',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Randomize slide order', 'textdomain' ),
							'options'      => array(
								'false' => __( 'false', 'textdomain' ),
								'true'  => __( 'true', 'textdomain' )
							),
							'default'      => 'false'
						),
						array(
							'id'           => 's_controlnav',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Manual control usage', 'textdomain' ),
							'options'      => array(
								'true'  => __( 'true', 'textdomain' ),
								'false' => __( 'false', 'textdomain' )
							),
							'default'      => 'true'
						),
						array(
							'id'           => 's_touch',
							'type'         => 'select',
							'option-block' => 'flex-slider',
							'box-title'    => __( 'Touch swipe', 'textdomain' ),
							'options'      => array(
								'true'  => __( 'true', 'textdomain' ),
								'false' => __( 'false', 'textdomain' )
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_skins',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Slider Skins', 'textdomain' ),
							'options'      => array(
								'theme-bar'     => __( 'bar', 'textdomain' ),
								'theme-default' => __( 'default', 'textdomain' ),
								'theme-dark'    => __( 'dark', 'textdomain' ),
								'theme-light'   => __( 'light', 'textdomain' )
							),
							'default'      => 'theme-bar'
						),
						array(
							'id'           => 'nv_animation',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Effect', 'textdomain' ),
							'options'      => array(
								'random'                 => __( 'random', 'textdomain' ),
								'sliceDownRight'         => __( 'sliceDownRight', 'textdomain' ),
								'sliceDownLeft'          => __( 'sliceDownLeft', 'textdomain' ),
								'sliceUpRight'           => __( 'sliceUpRight', 'textdomain' ),
								'sliceUpDown'            => __( 'sliceUpDown', 'textdomain' ),
								'sliceUpDownLeft'        => __( 'sliceUpDownLeft', 'textdomain' ),
								'fold'                   => __( 'fold', 'textdomain' ),
								'fade'                   => __( 'fade', 'textdomain' ),
								'boxRandom'              => __( 'boxRandom', 'textdomain' ),
								'boxRain'                => __( 'boxRain', 'textdomain' ),
								'boxRainReverse'         => __( 'boxRainReverse', 'textdomain' ),
								'boxRainGrow'            => __( 'boxRainGrow', 'textdomain' ),
								'boxRainGrowReverse	' => __( 'boxRainGrowReverse', 'textdomain' )
							),
							'default'      => 'random'
						),
						array(
							'id'           => 'nv_slice',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'For slice animations', 'textdomain' ),
							'default'      => '15'
						),
						array(
							'id'           => 'nv_boxCols',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'For box animations (Cols)', 'textdomain' ),
							'default'      => '8'
						),
						array(
							'id'           => 'nv_boxRows',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'For box animations (Rows)', 'textdomain' ),
							'default'      => '4'
						),
						array(
							'id'           => 'nv_animSpeed',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Slide transition speed', 'textdomain' ),
							'default'      => '500'
						),
						array(
							'id'           => 'nv_pauseTime',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'How long each slide will show', 'textdomain' ),
							'default'      => '3000'
						),
						array(
							'id'           => 'nv_startSlide',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Set starting Slide (0 index)', 'textdomain' ),
							'default'      => '0'
						),
						array(
							'id'           => 'nv_directionNav',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Next & Prev navigation', 'textdomain' ),
							'options'      => array(
								'true'  => __( 'true', 'textdomain' ),
								'false' => __( 'false', 'textdomain' ),
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_controlNav',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( '1,2,3... navigation', 'textdomain' ),
							'options'      => array(
								'true'  => __( 'true', 'textdomain' ),
								'false' => __( 'false', 'textdomain' ),
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_controlNavThumbs',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Use thumbnails for Control Nav', 'textdomain' ),
							'options'      => array(
								'true'  => __( 'true', 'textdomain' ),
								'false' => __( 'false', 'textdomain' ),
							),
							'default'      => 'false'
						),
						array(
							'id'           => 'nv_pauseOnHover',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Stop animation while hovering', 'textdomain' ),
							'options'      => array(
								'true'  => __( 'true', 'textdomain' ),
								'false' => __( 'false', 'textdomain' ),
							),
							'default'      => 'true'
						),
						array(
							'id'           => 'nv_manualAdvance',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Force manual transitions', 'textdomain' ),
							'options'      => array(
								'true'  => __( 'true', 'textdomain' ),
								'false' => __( 'false', 'textdomain' ),
							),
							'default'      => 'false'
						),
						array(
							'id'           => 'nv_prevText',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Prev directionNav text', 'textdomain' ),
							'default'      => __( 'Prev', 'textdomain' )
						),
						array(
							'id'           => 'nv_nextText',
							'type'         => 'text',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Next directionNav text', 'textdomain' ),
							'default'      => __( 'Next', 'textdomain' )
						),
						array(
							'id'           => 'nv_randomStart',
							'type'         => 'select',
							'option-block' => 'nivo-slider',
							'box-title'    => __( 'Start on a random slide', 'textdomain' ),
							'options'      => array(
								'true'  => __( 'true', 'textdomain' ),
								'false' => __( 'false', 'textdomain' ),
							),
							'default'      => 'false'
						),
					)

				),
				array(
					'id'    => 'slides',
					'type'  => 'slides',
					'label' => __( 'Slides', 'textdomain' ),
					'info'  => __( 'Add images to slider (Supported files .png, .jpg, .gif). If you want to change order, just drag and drop it. Image size for slides is original from media gallery, please upload images in same size, to get best display on page. To display slider in needed place use shortcode [dgc_slider]. Current theme version support only one slider per website.', 'textdomain' ),
				)
			)
		);

		/*Social Links*/
		$this->sections['social-links'] = array(
			'title'  => __( 'Social Links', 'textdomain' ),
			'id'     => 'social-links',
			'fields' => array(
				array(
					'id'      => 'sl_position',
					'label'   => __( 'Socials Links Position', 'textdomain' ),
					'info'    => __( 'Choose place where social links will be displayed.', 'textdomain' ),
					'type'    => 'select',
					'options' => array( '0' => __( 'Footer', 'textdomain' ), '1' => __( 'Header', 'textdomain' ) ),
					'default' => '0'
				),
				array(
					'id'     => 'social-links',
					'label'  => __( 'Socials Links', 'textdomain' ),
					'info'   => __( 'Add link to your social media profiles. Icons with link will be display in header or footer.', 'textdomain' ),
					'fields' => array(
						array(
							'id'        => 'facebook_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Facebook', 'textdomain' )
						),
						array(
							'id'        => 'twitter_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Twitter', 'textdomain' )
						),
						array(
							'id'        => 'linkedin_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'LinkedIn', 'textdomain' )
						),
						array(
							'id'        => 'myspace_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'MySpace', 'textdomain' )
						),
						array(
							'id'        => 'googleplus_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Google Plus+', 'textdomain' )
						),
						array(
							'id'        => 'dribbble_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Dribbble', 'textdomain' )
						),
						array(
							'id'        => 'skype_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Skype', 'textdomain' )
						),
						array(
							'id'        => 'flickr_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Flickr', 'textdomain' )
						),
						array(
							'id'        => 'youtube_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'You Tube', 'textdomain' )
						),
						array(
							'id'        => 'vimeo_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Vimeo', 'textdomain' )
						),
						array(
							'id'        => 'rss_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'RSS', 'textdomain' )
						),
						array(
							'id'        => 'vk_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Vk.com', 'textdomain' )
						),
						array(
							'id'        => 'instagram_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Instagram', 'textdomain' )
						),
						array(
							'id'        => 'pinterest_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Pinterest', 'textdomain' )
						),
						array(
							'id'        => 'yelp_url',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Yelp', 'textdomain' )
						),
						array(
							'id'        => 'email_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'E-mail', 'textdomain' )
						),
						array(
							'id'        => 'github_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Github', 'textdomain' )
						),
						array(
							'id'        => 'tumblr_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Tumblr', 'textdomain' )
						),
						array(
							'id'        => 'soundcloud_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Soundcloud', 'textdomain' )
						),
						array(
							'id'        => 'tripadvisor_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Tripadvisor', 'textdomain' )
						),
						array(
							'id'        => 'ello_link',
							'type'      => 'text',
							'default'   => '',
							'box-title' => __( 'Ello.co', 'textdomain' )
						),
					)
				),
			)
		);

		/*Footer*/
		$this->sections['footer'] = array(
			'title'  => __( 'Footer', 'textdomain' ),
			'id'     => 'footer',
			'fields' => array(
				array(
					'id'        => 'footer_text',
					'label'     => __( 'Footer options', 'textdomain' ),
					'info'      => __( 'Replace default theme copyright information and links', 'textdomain' ),
					'box-title' => __( 'Copyright section', 'textdomain' ),
					'type'      => 'textarea',
					'default'   => __( 'Powered by: <a href="https://github.com/dgc-network/">dgc-network</a>', 'textdomain' ),
				)
			)
		);

		/*Custom CSS*/
		$this->sections['custom-css'] = array(
			'title'  => __( 'Custom CSS', 'textdomain' ),
			'id'     => 'custom-css',
			'fields' => array(
				array(
					'id'        => 'custom_css',
					'label'     => __( 'Custom CSS', 'textdomain' ),
					'info'      => __( 'Theme has two css files style.css and fixed-style.css which use default styles for front-end responsive and static layout. Do not edit theme default css files, use textarea editor below for overwriting all css styles.', 'textdomain' ),
					'box-title' => __( 'Styles editor', 'textdomain' ),
					'type'      => 'textarea',
					'default'   => '',
				)
			)
		);

		/*Woocommerce*/
		if ( class_exists( 'Woocommerce' ) ) {
			$this->sections['woo'] = array(
				'title'  => __( 'Woocommerce', 'textdomain' ),
				'id'     => 'woo',
				'fields' => array(
					array(
						'id'          => 'showuser',
						'label'       => __( 'Show user button in header', 'textdomain' ),
						'info'        => __( 'If you want to display my-account link in header select options below.', 'textdomain' ),
						'type'        => 'checkbox',
						'description' => __( 'Enable', 'textdomain' ),
						'default'     => 'on',
					),
					array(
						'label'   => __( 'My Account button color', 'textdomain' ),
						'info'    => __( 'Choose color for my account icon', 'textdomain' ),
						'id'      => 'my_account_button_color',
						'type'    => 'color',
						'default' => '#020202',
					),
					array(
						'id'          => 'showcart',
						'label'       => __( 'Show cart in header', 'textdomain' ),
						'info'        => __( 'If you want to display cart link in header select options below.', 'textdomain' ),
						'type'        => 'checkbox',
						'description' => __( 'Enable', 'textdomain' ),
						'default'     => 'on',
					),
					array(
						'label'   => __( 'Cart color', 'textdomain' ),
						'info'    => __( 'Choose color for cart icon', 'textdomain' ),
						'id'      => 'cart_color',
						'type'    => 'color',
						'default' => '#020202',
					),
					array(
						'id'      => 'woo_shop_sidebar',
						'label'   => __( 'Woocommerce Shop Sidebar', 'textdomain' ),
						'info'    => __( 'Show or hide sidebar', 'textdomain' ),
						'type'    => 'select',
						'options' => array(
							'2' => __( 'Left sidebar', 'textdomain' ),
							'1' => __( 'Full width', 'textdomain' ),
							'3' => __( 'Right sidebar', 'textdomain' )
						),
						'default' => '2',
					),
					array(
						'id'      => 'woo_product_sidebar',
						'label'   => __( 'Woocommerce Product Sidebar', 'textdomain' ),
						'info'    => __( 'Show or hide sidebar', 'textdomain' ),
						'type'    => 'select',
						'options' => array(
							'1' => __( 'Full width with tabs on right side', 'textdomain' ),
							'2' => __( 'Left sidebar', 'textdomain' ),
							'3' => __( 'Right sidebar', 'textdomain' ),
							'4' => __( 'Full width with tabs on left side', 'textdomain' ),
							'5' => __( 'Full width with tabs in center', 'textdomain' )
						),
						'default' => '1',
					),
					array(
						'id'      => 'shop_num_row',
						'label'   => __( 'Woocommerce pages products per row', 'textdomain' ),
						'info'    => __( 'Choose number of products', 'textdomain' ),
						'type'    => 'select',
						'options' => array(
							'1' => __( '1 products', 'textdomain' ),
							'2' => __( '2 products', 'textdomain' ),
							'3' => __( '3 products', 'textdomain' ),
							'4' => __( '4 products', 'textdomain' ),
							'5' => __( '5 products', 'textdomain' )
						),
						'default' => '1',
					),
					array(
						'id'      => 'woo_shop_num_prod',
						'label'   => __( 'Number of products on Shop pages', 'textdomain' ),
						'info'    => __( 'Choose number of products. Write -1 for show all products on one page', 'textdomain' ),
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
		* @since dgc-theme 1.0
		*/
		$admin_page = add_theme_page(
			__( 'Theme Options', 'textdomain' ),                             // Name of page
			__( 'Theme Options', 'textdomain' ),                             // Label in menu
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
			'title' => __( 'Theme Options', 'textdomain' ),
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
						'textdomain' ) . '</span>';
				if ( ! empty( $data ) ) {
					$none = '';
				} else {
					$none = 'none';
				}
				$html .= '<span class="button reset_btn ' . $none . '" id="reset_' . esc_attr( $field['id'] ) . '" title="' . esc_attr( $field['id'] ) . '">' . __( 'Remove',
						'textdomain' ) . '</span>';
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
				$html .= '<div id="menu_sample_font" class="sample_text">' . __( 'Sample Font', 'textdomain' ) . '</div>';
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
	 * @since dgc-theme 1.0
	 */
	public function dgc_theme_options_render_page() {
		?>
        <div class="wrap">
            <h2></h2>
            <form method="post" action="/" enctype="multipart/form-data" class="form-admin-dgc"
                  id="form-admin-dgc">
                <div id="save_options" class="save-options"></div>
                <div class="header">
                    <h2 class="title_theme"><?php _e( 'Theme Options', 'textdomain' ); ?></h2>
					<?php submit_button( __( 'Save', 'textdomain' ) ); ?>
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
					<?php submit_button( __( 'Save', 'textdomain' ) ); ?>
                </div>
                <input type="hidden" name="action" value="dgc_theme_options_action"/>
                <input type="hidden" name="security" value="<?php echo wp_create_nonce( 'dgc_theme_data' ); ?>"/>
            </form>

            <div id="sidebar-promo" class="sidebar-promo">
                <div class="sidebar-promo-widget promo-support">
                    <h3><?php _e( 'Support', 'textdomain' ); ?></h3>
                    <p class="sidebar-promo-content"><?php
						_e( 'If You faced with problems or find error or bug, please', 'textdomain' );
						echo ' <a target="_blank" href="http://dgc.zendesk.com/hc/en-us/requests/new">';
						_e( 'submit request.', 'textdomain' );
						echo '</a> ';
						_e( 'On official ', 'textdomain' );
						echo ' <a target="_blank" href="http://wordpress.org/support/theme/dgc-theme">';
						_e( 'Support forum', 'textdomain' );
						echo '</a> ';
						_e( 'You may find answers on Your questions.', 'textdomain' );
						?></p>
                </div>
                <div class="sidebar-promo-widget promo-customization">
                    <h3><?php _e( 'Additional customization', 'textdomain' ); ?></h3>
                    <p class="sidebar-promo-content"><?php
						_e( 'Our team is available for any type of WordPress development. ', 'textdomain' );
						_e( 'If You want customize theme or add new features, You can', 'textdomain' );
						echo ' ';
						_e( 'submit order', 'textdomain' );
						echo ' ';
						_e( 'on our website', 'textdomain' );
						?></p>
                </div>
                <div class="sidebar-promo-widget promo-about">
                    <h3><?php _e( 'dgc-theme', 'textdomain' ); ?></h3>
                    <p class="sidebar-promo-content"><?php
						echo ' <a target="_blank" href="https://dgc.network/product/dgc-theme">';
						_e( 'dgc-theme - WordPress responsive theme', 'textdomain' );
						echo '</a> ';
						_e( ' that contains all the options of ', 'textdomain' );
						echo ' <a target="_blank" href="https://wordpress.org/themes/dgc-theme/">';
						_e( 'FREE version', 'textdomain' );
						echo '</a> ';
						_e( ' plus:', 'textdomain' );
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