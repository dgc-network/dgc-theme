<?php
/**
 * Makes a custom Widget for displaying Aside, Link, Status, and Quote Posts available
 *
 * @package WordPress
 * @subpackage dgc-wordpress-theme
 * @since dgc-wordpress-theme
 */
class DGC_Widget_Filter_Refine extends WP_Widget {
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	public function __construct() {
		$theme_name  = wp_get_theme();
		$widget_name = $theme_name.' '.__( 'Filter & Refine', 'taxonomy' );
		
		parent::__construct( 'widget_filter_refine', $widget_name, array(
			'classname'   => 'widget_filter_refine',
			'description' => __( 'Use this widget to filter and refine the products.', 'taxonomy' ),
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
		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
		$textarea_filter_refine = isset( $instance['textarea_filter_refine'] ) ? stripslashes( $instance['textarea_filter_refine'] ) : '';
?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'taxonomy' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'taxonomy' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>
			
			
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'textarea_filter_refine' ) ); ?>"><?php _e( 'Text Message:', 'taxonomy' ); ?></label>
			<textarea id="<?php 	echo esc_attr( $this->get_field_id( 'textarea_filter_refine' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea_newsarchiv' ) ); ?>" class="widefat" cols="16" rows="5"><?php echo stripslashes( $textarea_filter_refine ); ?></textarea></p>
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

		$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Filter & Refine', 'taxonomy' ) : $instance['title'], $instance, $this->id_base);
		$number 		= empty( $instance['number'] ) ? 10 : absint( $instance['number'] );
		$custom_content = empty ($instance['textarea_filter_refine']) ? null : stripslashes($instance['textarea_filter_refine']);
		
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
		 	$categories_list = get_the_category_list( __( ', ', 'taxonomy' ) );
			if ( $categories_list && dgc_categorized_blog() ) : ?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'taxonomy' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'taxonomy' ) );
			if ( $tags_list ) : ?>
			<span class="tag-links">
				<?php // printf( __( 'Tagged %1$s', 'taxonomy' ), $tags_list ); ?>
				<?php echo $tags_list; ?>
			</span> 
			<?php endif; // End if $tags_list ?>
		
			
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
			wp_enqueue_script('wdgt_news_arch', 	get_template_directory_uri() . '/inc/js/jxBox/jquery.bxSlider.js', array( 'jquery' ), '20120206', false );
			wp_enqueue_style( 'wdgt_news_style', 	get_template_directory_uri() . '/inc/js/jxBox/bx.css');
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

class DGC_Widget_News_Archive extends WP_Widget {
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	 public function __construct() {
		$theme_name  = wp_get_theme();
		$widget_name = $theme_name.' '.__( 'News Archive', 'taxonomy' );
		
		parent::__construct( 'widget_news_archive', $widget_name, array(
			'classname'   => 'widget_news_archive',
			'description' => __( 'Use this widget to list your Link posts.', 'taxonomy' ),
		) );
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

		$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'News-Archive', 'taxonomy' ) : $instance['title'], $instance, $this->id_base);
		$number 		= empty( $instance['number'] ) ? 10 : absint( $instance['number'] );
		$custom_content = empty ($instance['textarea_newsarchiv']) ? null : stripslashes($instance['textarea_newsarchiv']);
		
		$r = new WP_Query( 
			apply_filters(  'widget_posts_args', 
						array(  'posts_per_page' => -1, 
								'no_found_rows'  => true, 
								'post_status'    => 'publish', 
								'ignore_sticky_posts' => true 
							) 
						) 
			);
			
		if ($r->have_posts()) :
	?>
		<?php echo $args['before_widget'];  ?>
		<?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>
		
		<div class="news_archive_wrapper">
			<?php if ( $custom_content != '') { ?>
				<div class="news_archive_message"><p><?php echo $custom_content; ?></p></div>	
			<?php } ?>
			<ul class="news_archiv_list">
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
					<li id="arch_item_<?php echo $id_item; ?>" class="news_archiv_item">
						<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php echo esc_attr( get_the_date( 'd.m.Y' ) ); ?></br><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
					</li>
			<?php endwhile; ?>
			</ul>
		</div>
		
		<?php echo $args['after_widget']; ?>
		
		<?php
			wp_enqueue_script('wdgt_news_arch', 	get_template_directory_uri() . '/inc/js/jxBox/jquery.bxSlider.js', array( 'jquery' ), '20120206', false );
			wp_enqueue_style( 'wdgt_news_style', 	get_template_directory_uri() . '/inc/js/jxBox/bx.css');
		?>			
	
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#<?php echo $args['widget_id']; ?> .news_archiv_list').bxSlider({
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

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['textarea_newsarchiv'] = stripslashes($new_instance['textarea_newsarchiv']);

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_news_archive'] ) )
			delete_option( 'widget_news_archive' );

		return $instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 **/
	function form( $instance ) {
		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
		$textarea_newsarchive = isset( $instance['textarea_newsarchiv'] ) ? stripslashes( $instance['textarea_newsarchiv'] ) : '';
?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'taxonomy' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'taxonomy' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>
			
			
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'textarea_newsarchiv' ) ); ?>"><?php _e( 'Text Message:', 'taxonomy' ); ?></label>
			<textarea id="<?php 	echo esc_attr( $this->get_field_id( 'textarea_newsarchiv' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea_newsarchiv' ) ); ?>" class="widefat" cols="16" rows="5"><?php echo stripslashes( $textarea_newsarchive ); ?></textarea></p>
		<?php
	}
}