<?php

function dgc_add_admin_style() {
	if(is_rtl()){
		wp_enqueue_style('admin-style', 	get_template_directory_uri() . '/inc/css/admin-rtl.css');
	} else {
		wp_enqueue_style('admin-style',		get_template_directory_uri() . '/inc/css/admin.css');
	}
	wp_enqueue_style('fonts-style', 		get_template_directory_uri() . '/inc/css/fonts-style.css');
	wp_enqueue_style('ch-style',			get_template_directory_uri() . '/inc/js/ch/ch.css');
	wp_enqueue_style('sl-style',			get_template_directory_uri() . '/inc/js/sl/jquery.formstyler.css');
	wp_enqueue_style('dialog', 				get_template_directory_uri() . '/inc/js/dialogBox/jquery-impromptu.css');
	wp_enqueue_style( 'wp-color-picker' );
}

function dgc_add_jquery_script() {
	wp_enqueue_script('wp-color-picker');
	
	if( function_exists( 'wp_enqueue_media' ) ){
		wp_enqueue_media();
	} else {
		wp_enqueue_style ('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
	
	wp_enqueue_script('chJq',				get_template_directory_uri() . "/inc/js/ch/ch.js", array('jquery'));
	wp_enqueue_script('slJq',				get_template_directory_uri() . "/inc/js/sl/jquery.formstyler.min.js", array('jquery'));
	wp_enqueue_script('dialog', 			get_template_directory_uri() . "/inc/js/dialogBox/jquery-impromptu.min.js",  array('jquery'));
	wp_enqueue_script('uploads_',			get_template_directory_uri() . "/inc/js/uploads_.js", array('jquery'));
	wp_enqueue_script('cookie_',			get_template_directory_uri() . "/inc/js/cookie_.js", array('jquery'));
	wp_enqueue_script('admin-jQuery-fruit',	get_template_directory_uri() . "/inc/js/main.js", array('jquery'));
}

function dgc_fonts_list() {
	$font_family_options = array(
			'Arial, Helvetica, sans-serif'  				    => __( 'Arial, Helvetica, sans-serif', 'dgc' ),
			'Arial Black, Gadget, sans-serif'				    => __( 'Arial Black, Gadget, sans-serif', 'dgc' ),
			'Comic Sans MS, Textile, cursive' 				    => __( 	'Comic Sans MS, Textile, cursive', 'dgc' ),
			'Courier New, Courier, monospace'			 	    => __( 'Courier New, Courier, monospace', 'dgc' ),
			'Georgia, Times New Roman, Times, serif'	 	    => __( 'Georgia, Times New Roman, Times, serif', 'dgc' ),
			'Impact, Charcoal, sans-serif' 				 	    => __( 'Impact, Charcoal, sans-serif', 'dgc' ),
			'Lucida Console, Monaco, monospace' 			    => __( 'Lucida Console, Monaco, monospace', 'dgc' ),
			'Lucida Sans Unicode, Lucida Grande, sans-serif'	=> __( 'Lucida Sans Unicode, Lucida Grande, sans-serif', 'dgc' ),
			'Palatino Linotype, Book Antiqua, Palatino, serif' 	=> __( 'Palatino Linotype, Book Antiqua, Palatino, serif', 'dgc' ),
			'Tahoma, Geneva, sans-serif' 						=> __( 'Tahoma, Geneva, sans-serif', 'dgc' ),
			'Times New Roman, Times, serif'						=> __( 'Times New Roman, Times, serif', 'dgc' ),
			'Trebuchet MS, Helvetica, sans-serif' 				=> __( 'Trebuchet MS, Helvetica, sans-serif', 'dgc' ),
			'Verdana, Geneva, sans-serif'						=> __( 'Verdana, Geneva, sans-serif', 'dgc' ),
			'MS Sans Serif, Geneva, sans-serif' 				=> __( 'MS Sans Serif, Geneva, sans-serif', 'dgc' ),
			'MS Serif, New York, serif' 						=> __( 'MS Serif, New York, serif', 'dgc' ),
			
			/*Google fonts*/	
			'Open Sans, sans-serif' 							=> __( 'Open Sans, sans-serif', 'dgc' ),
			'Lobster, cursive' 									=> __( 'Lobster, cursive', 'dgc' ),
			'Josefin Slab, serif' 								=> __( 'Josefin Slab, serif', 'dgc' ),
			'Arvo, serif' 										=> __( 'Arvo, serif', 'dgc' ),
			'Lato, sans-serif' 									=> __( 'Lato, sans-serif', 'dgc' ),
			'Vollkorn, serif' 									=> __( 'Vollkorn, serif', 'dgc' ),
			'Abril Fatface, cursive' 							=> __( 'Abril Fatface, cursive', 'dgc' ),
			'Ubuntu, sans-serif'								=> __( 'Ubuntu, sans-serif', 'dgc' ),
			'PT Sans, sans-serif'								=> __( 'PT Sans, sans-serif', 'dgc' ),
			'Old Standard TT, serif' 							=> __( 'Old Standard TT, serif', 'dgc' ),
			'Droid Sans, sans-serif' 							=> __( 'Droid Sans, sans-serif', 'dgc' ),
	);

	return apply_filters( 'dgc_fonts_list', $font_family_options );
}

 function dgc_custom_do_settings_sections($page) {
    global $wp_settings_sections, $wp_settings_fields;
	$id_=0;
	$optins = (array) get_option( 'dgc_theme_options' );
    if ( !isset($wp_settings_sections) || !isset($wp_settings_sections[$page]) )
        return;
    foreach( (array) $wp_settings_sections[$page] as $section ) {
        call_user_func($section['callback'], $section);
        if ( !isset($wp_settings_fields) ||
             !isset($wp_settings_fields[$page]) ||
             !isset($wp_settings_fields[$page][$section['id']]) )
                continue;
        	 
		$name_id = "settings-section-" . $id_;
		print '<div id="'. $name_id .'" class="settings-section">';
				dgc_custom_do_settings_fields($page, $section['id']);
		print '</div>';
		$id_++;		 
    }
}


function dgc_custom_do_settings_fields($page, $section) {
    global $wp_settings_fields;
	$id_=0;

    if ( !isset($wp_settings_fields) ||
         !isset($wp_settings_fields[$page]) ||
         !isset($wp_settings_fields[$page][$section]) )
        return;
		
    foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
        if (!empty($field['args']['newrow'])) {
			print '<div id="set_form_row_' . $id_ .'" class="settings-form-row newrow">';
		} else {
			print '<div id="set_form_row_' . $id_ .'" class="settings-form-row">';
		}
		
        if ( !empty($field['args']['label_for']) )
            print '<h3 class="main-header-options">' . esc_attr($field['title']);
        else
            print '<h3 class="main-header-options">' . esc_attr($field['title']);
			print '</h3>';
				print '<span class="add_element_info">'. $field['args']['info'] .'</span>';
				if (!empty($field['args']['fields'])) {
					$id = (isset($field['args']['id'])) ? $field['args']['id'] : '';
					if($id == 'slider-options' ) {
						print '<div class="box-options">';
							print '<input type="button" id="view_all_options" class="button-secondary" value="'.__( 'View Options','dgc').'" />'; 
							print '<div id="slider_main_options" class="slider-main-options">';
								print '	<div class="no-slider-select">';
									print '	<div class="option_block">';
										print '<h4>'.__('No Slider Select!', 'dgc' ).'</h4>';
									print '</div>';
								print '</div>';
								foreach($field['args']['fields'] as $row => $value){
									print '<div class="option_block '.$value['option-block'].'">';
										call_user_func($field['callback'], $field['args']['fields'][$row]); 
									print '</div>';	
								}	
							print '</div>';
						print '</div>';
					}
					else {
						print '<div class="box-options">';
						foreach($field['args']['fields'] as $row => $value){
							print '<div class="box-option">';
								call_user_func($field['callback'], $field['args']['fields'][$row]); 
							print '</div>';	
						}	
						print '</div>';	
					}	

				}
				else {
					print '<div class="box-options">';
						print '<div class="box-option">';
						call_user_func($field['callback'], $field['args']);
					print '</div></div>';				
				}
				print '</div>';	
			$id_++;		 
    }
}

add_action('wp_ajax_dgc_add_new_slide_action', 'dgc_new_slide');
function dgc_new_slide() {
	$slides = (array) get_option( 'dgc_theme_slides_options' );
	$data 	 = $_POST['data'];
	echo dgc_get_slide($data, -1, ''); 
	die();
}

function dgc_get_box_upload_slide($attach_id, $link_url, $is_blank, $is_active, $ind, $btnclassup = 'upload_btn',  $btnclassr = 'reset_btn') {
	$out  = ''; 
	$out .= '<div class="box-image">';
	if ($attach_id != -1) {
		$out .= '<div class="img-container custom-slide">';
			$image_attributes = wp_get_attachment_image_src($attach_id, 'full');
			$out .= '<img src="'.esc_url_raw($image_attributes[0]).'" alt="" />';
		$out .= '</div>	';
				
	}
		/*Link out for Slider*/
		$out .= '<label for="slide-link-'.$ind.'">'. __('Link URL', 'dgc') .'</label>';
		$out .= '<input type="text" name="dgc_theme_options[slides][slide-'.$ind.'][link]" id="slide-link-'.$ind.'" class="slide-link-'.$ind.' text-input" value="'.esc_url($link_url).'"/>';
		$out .= '<div class="clear"></div>';

		$out .= '<label for="link-blank-'.$ind.'">';
		$out .= '<input type="checkbox" name="dgc_theme_options[slides][slide-'.$ind.'][is_blank]" id="link-blank-'.$ind.'" class="link-target-'.$ind.'" '. checked( 'on', $is_blank, false) .'/>';
		$out .= __('Target "_blank"', 'dgc') .'</label>';
	
	        // ADD IS_ACTIVE OPTION by ERICH
		$out .= '<div class="clear" style="margin-bottom: 10px;"></div>';
		$out .= '<label for="link-active-' . $ind . '">';
		$out .= '<input type="checkbox" name="dgc_theme_options[slides][slide-' . $ind . '][is_active]" id="link-active-' . $ind . '" class="link-target-' . $ind . '" ' . checked( 'on', $is_active, false ) . '/>';
		$out .= __( 'Active (show sliderimage)', 'dgc' ) . '</label>';
  
	
		$out .= '<input class="of-input" name="dgc_theme_options[slides][slide-'.$ind.'][attach_id]" id="attach-'.$ind.'" type="hidden" value="'. intval($attach_id) .'" />';
		$out .= '<div class="upload_button_div">';
			$out .= '<span data-imagetype="slide" class="button '. $btnclassup .'" id="add-slide-btn-'. $ind .'">'.__('Upload Image', 'dgc') .'</span>';
			$out .= '<span class="button reset_btn">'.__('Remove', 'dgc') .'</span>';
		$out .= '</div>';
	$out .= '</div>';
	return $out;
}

function dgc_get_slide($ind, $id, $link_url = null, $is_blank = 'off', $is_active = 'on') {
	$out = '';
	$out .= '<li class="slide" id="slide-image-' . $ind . '">';
		$out .= '<h4 class="slide-header" id="slide-header-'. $ind .'">' . sprintf(__('Slide # %1$d', 'dgc'),   $ind);
			$out .= '<span class="content-close-slide" id="content-slide-close_' . $ind . '"></span>';
				$out .= '<span class="remove-slide" id="remove-slide-'.$ind.'"></span>';
		$out .= '</h4>';
		
		$out .= '<div class="slide-content" id="slide-content-'. $ind .'">';
			$out .= dgc_get_box_upload_slide($id, $link_url, $is_blank, $is_active, $ind);
		$out .= '</div>';
	$out .= '</li>';
	return $out;
}	

function dgc_slider_images() {
	global $dgc_theme_options;
	$slides = get_option($dgc_theme_options->args['opt_name']);
	$vcount_slides = 0;
	if(!empty($slides['slides'])) {
		$vcount_slides  = count($slides['slides']); 
	}
	?>
		<div class="slides-btn">
			<span class="collapse_all"><?php _e('Collapse all', 'dgc'); ?></span>
			<span class="expand_all"><?php _e('Expand all', 'dgc'); ?></span>
		</div>
		<ul class="slides">
			<?php 
					/*Init First Slide for noraml work script*/
					if ($vcount_slides == 0) {
						echo dgc_get_slide(1, -1); 
					} else {
						foreach ($slides['slides'] as $key=>$slide) {
							$slide_inndex = -1;
							$attach_id 	  = $slide['attach_id'];
							$link_url = null;
							$is_blank = 'off';
							$is_active = ( isset( $slide['is_active'] ) ) ? 'on' : 'off'; //ERICH
							
							$slide_inndex = trim(substr($key, strrpos($key, '-')+1, 5));
							if (isset($slide['link'])) { $link_url = $slide['link']; }
							if (isset($slide['is_blank'])) { $is_blank = $slide['is_blank']; }
							echo dgc_get_slide($slide_inndex, $attach_id, esc_url($link_url), $is_blank, $is_active); 
						}
					}
			?>
		</ul>
		<input type="button" class="button-primary add_new_btn" value="<?php _e('Add New Slide', 'dgc'); ?>" />
<?php
}

add_action('wp_ajax_run_import_dummy_data', 'dgc_run_import_dummy_data');
function dgc_run_import_dummy_data() {
	$vIsUpdate = false;
	$vIsUpdate = dgc_create_home_page();
	echo $vIsUpdate;
	die();
}

add_action('wp_ajax_dgc_theme_options_action', 'dgc_data_save');
function dgc_data_save() {
global $dgc_theme_options;
	$data = $_POST[$dgc_theme_options->args['opt_name']];
	foreach ( $dgc_theme_options->sections as $section => $data_f ) {
		foreach ( $data_f['fields'] as $field ) {
			$id = (isset($field['id' ])) ? $field['id'] : '';
			$type = (isset($field['type'])) ? $field['type'] : '';
				if ($type == 'checkbox') {
					if (!isset($data[$id])) {$data[$id] = 'off'; }
				}
				if ($type == 'textarea') {
					if (isset($data[$id])) {$data[$id] = stripslashes($data[$id]);}
				}				
			if (!empty ($field['fields'])) {
				foreach ($field['fields'] as $sub_field) {
					$id  = (isset($sub_field['id' ])) ? $sub_field['id'] : '';
					$type = (isset($sub_field['type'])) ? $sub_field['type'] : '';
					if ($type == 'checkbox') {
						if (!isset($data[$id])) {$data[$id] = 'off'; }
					}
					if ($type == 'textarea') {
						if (isset($data[$id])) {$data[$id] = stripslashes($data[$id]);}
					}					
				}
			}					
		}
	}	
	if (!isset($data['reset'])) {$data['reset']	= 'reset';}
	if(!empty($data)) {
		if(update_option('dgc_theme_options', $data)) {
			die('1');
		} else {
			die('0');
		}
	} else {
		die('1');  
	}

}

function dgc_get_default_array() {
global $dgc_theme_options;
	$output = array();
	foreach ( $dgc_theme_options->sections as $section => $data_f ) {
		foreach ( $data_f['fields'] as $field ) {
			$id = (isset($field['id' ])) ? $field['id'] : '';
			$default =  (isset($field['default' ])) ? $field['default'] : '';
			$output[$id] = $default;
			if (!empty ($field['fields'])) {
				foreach ($field['fields'] as $sub_field) {
					$id  = (isset($sub_field['id' ])) ? $sub_field['id'] : '';
					$default =  (isset($sub_field['default' ])) ? $sub_field['default'] : '';	
					$output[$id] = $default;
				}
			}	
		}
	}
	return apply_filters( 'themeslug_option_defaults', $output );
}

function dgc_get_theme_options() {
	global $dgc_theme_options;
    return wp_parse_args( 
        get_option($dgc_theme_options->args['opt_name'], array() ), 
        dgc_get_default_array() 
    );
}

add_action('wp_ajax_dgc_reset_btn', 'dgc_reset_action');
function dgc_reset_action() {
global $dgc_theme_options;
	 delete_option($dgc_theme_options->args['opt_name']);
	 die();	
}

function dgc_theme_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {return 'on';} else {return 'off';}
}

?>
