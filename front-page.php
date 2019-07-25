<?php
/**
 * The template for displaying Home Page.
 *
 * @package WordPress
 * @subpackage dgc-network theme
 * @since dgc-network theme 1.0
 */

get_header(); ?>

	<?php dgc_get_content_with_custom_sidebar('homepage'); ?>
		
<?php get_footer(); ?>