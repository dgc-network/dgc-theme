<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage dgc-theme
 * @since dgc-theme 1.0
 */
?>
				</div>
			</div>
		</div><!-- .page-container-->
		<footer id="colophon" class="site-footer" role="contentinfo">

			<style type="text/css">
			/* * {margin: 0; padding: 0;} */
			#footer-widgets {height: 100%; width:100%; font-size: 0; background: gray;}
			#sub-footer-widgets, #footer-widget-4{display: inline-block; *display: inline; zoom: 1; vertical-align: top; font-size: 12px;}
			#sub-footer-widgets {height: 100%; width:80%; font-size: 0; background: gray;}
			#footer-widget-1, #footer-widget-2, #footer-widget-3{display: inline-block; *display: inline; zoom: 1; vertical-align: top; font-size: 12px;}
			#footer-widget-1 {width: 25%;}
			#footer-widget-2 {width: 25%;}
			#footer-widget-3 {width: 25%;}
			#footer-widget-4 {width: 12%; background: url(/images/payment_icons.png); align:right;}
			</style>

			<div class="container">
				<div class="sixteen columns">
					<!-- <aside class="widget-area" role="complementary"> -->
					<div id="footer-widgets">
					<div id="sub-footer-widgets">
						<?php
						if ( is_active_sidebar( 'footer-1' ) ) { ?>
							<div id="footer-widget-1">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div>
						<?php }
						if ( is_active_sidebar( 'footer-2' ) ) { ?>
							<div id="footer-widget-2">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div>
						<?php }
						if ( is_active_sidebar( 'footer-3' ) ) { ?>
							<div id="footer-widget-3">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div>
						<?php } ?>
					</div>
						<?php
						if ( is_active_sidebar( 'footer-4' ) ) { ?>
							<div id="footer-widget-4">
								<?php dynamic_sidebar( 'footer-4' ); ?>
							</div>
						<?php } ?>
					</div>
					<!-- .widget-area -->

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