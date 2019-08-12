<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage dgc-wordpress-theme
 * @since dgc-wordpress-theme 1.0
 */
?>
				</div>
			</div>
		</div><!-- .page-container-->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="sixteen columns">

				<?php
				if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) ||
					is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) :
				?>

					<!-- <aside class="widget-area" role="complementary"> -->
					<div id='footer-widgets'>
						<div id="footer-widget1">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) : ?>
							<h2>Hello</h2>
							<?php endif; ?>
						</div>
						<div id="footer-widget2">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2') ) : ?>
							<h2>Hello</h2>
							<?php endif; ?>
						</div>
						<div id="footer-widget3">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3') ) : ?>
							<h2>Hello</h2>
							<?php endif; ?>
						</div>
						<div id="footer-widget4">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-4') ) : ?>
							<h2>Hello</h2>
							<?php endif; ?>
						</div>
					</div>
					<div style="clear-both"></div>

						<?php
						//if ( is_active_sidebar( 'footer-1' ) ) { ?>
							<div class="widget-column footer-widget-1" width=20%>
								<?php //dynamic_sidebar( 'footer-1' ); ?>
							</div>
						<?php //}
						//if ( is_active_sidebar( 'footer-2' ) ) { ?>
							<div class="widget-column footer-widget-2" width=20%>
								<?php //dynamic_sidebar( 'footer-2' ); ?>
							</div>
						<?php //}
						//if ( is_active_sidebar( 'footer-3' ) ) { ?>
							<div class="widget-column footer-widget-3" width=20%>
								<?php //dynamic_sidebar( 'footer-3' ); ?>
							</div>
						<?php //}
						//if ( is_active_sidebar( 'footer-4' ) ) { ?>
							<div class="widget-column footer-widget-4" width=20%>
								<?php //dynamic_sidebar( 'footer-4' ); ?>
							</div>
						<?php //} ?>
					<!-- </aside> --><!-- .widget-area -->

				<?php endif; ?>

					<div class="site-info">
						<?php dgc_get_footer_text(); ?>
					</div><!-- .site-info -->
					<?php if (!dgc_is_social_header()) { 	
							   dgc_get_socials_icon(); 
						  } 
					?>
				</div>
			</div>
			<div id="back-top">
				<a rel="nofollow" href="#top" title="<?php _e('Back to top', 'textdomain'); ?>">&uarr;</a>
			</div>
		</footer><!-- #colophon .site-footer -->
	<!--WordPress Development by dgc-network-->
<?php wp_footer(); ?>
</body>
</html>