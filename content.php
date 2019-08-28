<?php
/**
 * @package WordPress
 * @subpackage dgc-theme
 * @since dgc-theme 1.0
 */
?>
<?php $options = dgc_get_theme_options(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog_post'); ?>>
	<div class="post-content">	

		<?php if ( (is_search())) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>

		<div class="entry-content">
			<?php the_content( __( 'Read More <span class="meta-nav">&rarr;</span>', 'textdomain' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'textdomain' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php dgc_entry_meta(); ?>
		
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'textdomain' ), __( '1 Comment', 'textdomain' ), __( '% Comments', 'textdomain' ) ); ?></span>
			<?php } ?>
		</footer><!-- .entry-meta -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
