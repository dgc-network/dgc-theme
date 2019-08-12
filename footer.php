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

<style type="text/css">
* {margin: 0; padding: 0;}
#container {height: 100%; width:100%; font-size: 0;}
#left, #middle, #right {display: inline-block; *display: inline; zoom: 1; vertical-align: top; font-size: 12px;}
#left {width: 25%; background: blue;}
#middle {width: 50%; background: green;}
#right {width: 25%; background: yellow;}
</style>

<div id="container">
    <div id="left">Left Side Menu</div>
    <div id="middle">Random Content</div>
    <div id="right">Right Side Menu</div>
</div>

			<div id="chunkyfooter">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) ?>
			</div>

			<div id='footer-widgets' width=100%>
						<div id="footer-widget1" width=20%>
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) : ?>
							<?php endif; ?>
						</div>
						<div id="footer-widget2" width=20%>
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2') ) : ?>
							<?php endif; ?>
						</div>
						<div id="footer-widget3" width=20%>
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3') ) : ?>
							<?php endif; ?>
						</div>
						<div id="footer-widget4" width=20%>
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-4') ) : ?>
							<?php endif; ?>
						</div>
			</div>
			<div style="clear-both"></div>

			<div class="container">
				<div class="sixteen columns">

				<?php
				if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) ||
					is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) :
				?>

					<!-- <aside class="widget-area" role="complementary"> -->
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