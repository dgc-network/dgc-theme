<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage dgc-network theme
 * @since dgc-network theme 1.0
 */

get_header(); ?>
	
	<?php dgc_get_content_with_custom_sidebar('page'); ?>
	
<?php get_footer(); ?>