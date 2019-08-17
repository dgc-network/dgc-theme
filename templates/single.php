<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage dgc-theme
 * @since dgc-theme 1.0
 */

get_header(); ?>

	<?php dgc_get_content_with_custom_sidebar('single-post'); ?>

<?php get_footer(); ?>