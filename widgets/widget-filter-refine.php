<?php
/**
 * Makes a custom Widget for displaying Aside, Link, Status, and Quote Posts available
 *
 * @package WordPress
 * @subpackage dgc-theme
 * @since dgc-theme
 */
class DGC_Filter_Refine_Widget extends WP_Widget {
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	public function __construct() {
		$theme_name  = wp_get_theme();
		$widget_name = $theme_name.' '.__( 'Filter & Refine', 'textdomain' );
		
		parent::__construct( 'widget_filter_refine', $widget_name, array(
			'classname'   => 'widget_filter_refine',
			'description' => __( 'Use this widget to filter and refine the products.', 'textdomain' ),
		) );
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['textarea_filter_refine'] = stripslashes($new_instance['textarea_filter_refine']);

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_filter_refine'] ) )
			delete_option( 'widget_filter_refine' );

		return $instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 **/
	function form( $instance ) {
		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : 'Filter & Refine';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
		$textarea_filter_refine = isset( $instance['textarea_filter_refine'] ) ? stripslashes( $instance['textarea_filter_refine'] ) : '';
?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'textdomain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'textdomain' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>
			
			
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'textarea_filter_refine' ) ); ?>"><?php _e( 'Text Message:', 'textdomain' ); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'textarea_filter_refine' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea_filter_refine' ) ); ?>" class="widefat" cols="16" rows="5"><?php echo stripslashes( $textarea_filter_refine ); ?></textarea></p>
		<?php
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array An array of standard parameters for widgets in this theme
	 * @param array An array of settings for this widget instance
	 * @return void Echoes it's output
	 **/
	public function widget( $args, $instance ) {
		$id_item = 0;
		if (!isset( $args['widget_id'] ) ) 
			$args['widget_id'] = null;
		
		if (isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Filter & Refine', 'textdomain' ) : $instance['title'], $instance, $this->id_base);
		$number 		= empty( $instance['number'] ) ? 10 : absint( $instance['number'] );
		$custom_content = empty( $instance['textarea_filter_refine']) ? null : stripslashes($instance['textarea_filter_refine']);
		
		$products = new WP_Query(
			apply_filters(  'widget_posts_args', 
				array(  'posts_per_page' => -1, 
						'no_found_rows'  => true, 
						'post_type'    => 'product', 
						'ignore_sticky_posts' => true 
					) 
				) 
			);

			$r = new WP_Query(
			apply_filters(  'widget_posts_args', 
						array(  'posts_per_page' => -1, 
								'no_found_rows'  => true, 
								'post_type'    => 'product', 
								'ignore_sticky_posts' => true 
							) 
						) 
			);
	?>

		<?php echo $args['before_widget'];  ?>
		<?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>
		<div class="filter_refine_wrapper">
			<?php if ( $custom_content != '') { ?>
				<div class="filter_refine_message"><p><?php echo $custom_content; ?></p></div>	
			<?php } ?>

			<div>
				<input type="checkbox" name="vehicle1" value="Bike"> Product Code<br>
				<input type="checkbox" name="vehicle2" value="Car"> Product Title<br>
				<input type="checkbox" name="vehicle3" value="Boat"> Keyword<br><br>
			</div>
			<div>
				<h4>Publisher</h4>
				<input type="checkbox" name="vehicle1" value="Bike"> AGA<br>
				<input type="checkbox" name="vehicle2" value="Car"> AGI<br>
				<input type="checkbox" name="vehicle3" value="Boat"> ASCE<br>
				<input type="checkbox" name="vehicle1" value="Bike"> ASHRAE<br>
				<input type="checkbox" name="vehicle2" value="Car"> ASME<br>
				<input type="checkbox" name="vehicle3" value="Boat"> ASTM<br>
				<input type="checkbox" name="vehicle3" value="Boat"> BSI<br><br>
			</div>

			<div>
				<h4>Tags</h4>
<?php
$get_terms_default_attributes = array (
	'textdomain' => 'category', //empty string(''), false, 0 don't work, and return empty array
	'orderby' => 'name',
	'order' => 'ASC',
	'hide_empty' => true, //can be 1, '1' too
	'include' => 'all', //empty string(''), false, 0 don't work, and return empty array
	'exclude' => 'all', //empty string(''), false, 0 don't work, and return empty array
	'exclude_tree' => 'all', //empty string(''), false, 0 don't work, and return empty array
	'number' => false, //can be 0, '0', '' too
	'offset' => '',
	'fields' => 'all',
	'name' => '',
	'slug' => '',
	'hierarchical' => true, //can be 1, '1' too
	'search' => '',
	'name__like' => '',
	'description__like' => '',
	'pad_counts' => false, //can be 0, '0', '' too
	'get' => '',
	'child_of' => false, //can be 0, '0', '' too
	'childless' => false,
	'cache_domain' => 'core',
	'update_term_meta_cache' => true, //can be 1, '1' too
	'meta_query' => '',
	'meta_key' => array(),
	'meta_value'=> '',
);
$get_terms_default_attributes = array (
	'textdomain' => 'product_tag',
	'orderby' => 'name',
);

$terms = get_terms( 'product_tag' );
$term_array = array();
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    foreach ( $terms as $term ) {
        $term_array[] = $term->name;
    }
}

$get_terms_default_attributes = array (
	'textdomain' => 'product_tag', //empty string(''), false, 0 don't work, and return empty array
	'orderby' => 'name',
	'order' => 'ASC',
	'hide_empty' => true, //can be 1, '1' too
	'include' => 'all', //empty string(''), false, 0 don't work, and return empty array
	'exclude' => 'all', //empty string(''), false, 0 don't work, and return empty array
	'exclude_tree' => 'all', //empty string(''), false, 0 don't work, and return empty array
	'number' => false, //can be 0, '0', '' too
	'offset' => '',
	'fields' => 'all',
	'name' => '',
	'slug' => '',
	'hierarchical' => true, //can be 1, '1' too
	'search' => '',
	'name__like' => '',
	'description__like' => '',
	'pad_counts' => false, //can be 0, '0', '' too
	'get' => '',
	'child_of' => false, //can be 0, '0', '' too
	'childless' => false,
	'cache_domain' => 'core',
	'update_term_meta_cache' => true, //can be 1, '1' too
	'meta_query' => '',
	'meta_key' => array(),
	'meta_value'=> '',
);

$terms = get_terms( $get_terms_default_attributes );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    foreach ( $terms as $term ) { ?>
		<input type="checkbox" name="vehicle1" value="Bike"> <?php __( $term->name, 'textdomain') ?><br>
    <?php }
}				
?>
				<input type="checkbox" name="vehicle1" value="Bike"> Home<br>
				<input type="checkbox" name="vehicle2" value="Car"> Natual Waters<br>
				<input type="checkbox" name="vehicle3" value="Boat"> Organic Carbon<br>
				<input type="checkbox" name="vehicle1" value="Bike"> Organic Coatings<br>
				<input type="checkbox" name="vehicle2" value="Car"> Plain Steel<br>
				<input type="checkbox" name="vehicle3" value="Boat"> Surfaces<br>
				<input type="checkbox" name="vehicle3" value="Boat"> Testing Machines<br><br>
			</div>
			<div>
				<h4>Published Date</h4>
				<input type="text" name="vehicle1" width="30%" value="2018"> - 
				<input type="text" name="vehicle2" width="30%" value="2019">
			</div>

			<?php
			/* translators: used between list items, there is a space after the comma */
		 	$categories_list = get_the_category_list( __( ', ', 'textdomain' ) );
			if ( $categories_list && dgc_categorized_blog() ) : ?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'textdomain' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'textdomain' ) );
			if ( $tags_list ) : ?>
			<span class="tag-links">
				<?php // printf( __( 'Tagged %1$s', 'textdomain' ), $tags_list ); ?>
				<?php echo $tags_list; ?>
			</span> 
			<?php endif; // End if $tags_list ?>
		</div>
		<?php echo $args['after_widget']; ?>
		
			
	<?php if ($r->have_posts()) :
			echo $args['before_widget'];  ?>
		<?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>
		
		<div class="filter_refine_wrapper">
			<?php if ( $custom_content != '') { ?>
				<div class="filter_refine_message"><p><?php echo $custom_content; ?></p></div>	
			<?php } ?>
			<ul class="filter_refine_list">
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
					<li id="arch_item_<?php echo $id_item; ?>" class="filter_refine_item">
						<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
						<?php echo esc_attr( get_the_date( 'd.m.Y' ) ); ?></br>
						<?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
					</li>
			<?php endwhile; ?>
			</ul>
		</div>
		
		<?php echo $args['after_widget']; ?>
		
		<?php
			wp_enqueue_script('wdgt_news_arch', 	get_template_directory_uri() . '/includes/js/jxBox/jquery.bxSlider.js', array( 'jquery' ), '20120206', false );
			wp_enqueue_style( 'wdgt_news_style', 	get_template_directory_uri() . '/includes/js/jxBox/bx.css');
		?>			
	
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#<?php echo $args['widget_id']; ?> .filter_refine_list').bxSlider({
						mode: 'vertical',
						displaySlideQty: <?php echo $instance['number']; ?>,
						moveSlideQty: 1,
						hideControlOnEnd: true,
						adaptiveHeightSpeed:true
				});
			});		
		</script>
		
		<?php
		wp_reset_postdata();
		endif;
	}
}

// register widget
if (!function_exists('dgc_filter_refine_widget')) {
	function dgc_filter_refine_widget() {
		register_widget('DGC_Filter_Refine_Widget');
	}
	add_action('widgets_init', 'dgc_filter_refine_widget');
}
