<?php
/**
 * The template for displaying search forms in dgc-theme
 *
 * @package WordPress
 * @subpackage dgc-theme
 * @since dgc-theme 1.0
 */?>
	
<form method="get" id="searchform" class="fas fa-search" action="<?php echo esc_url( home_url() ); ?>" role="search">
	<label for="s" class="assistive-text"><?php _e( 'Search', 'textdomain' ); ?></label>
	<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Type Here to Search', 'textdomain' ); ?>" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'textdomain' ); ?>" />
</form>
