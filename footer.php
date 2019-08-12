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
#footer1, #footer2, #footer3, #footer4 {display: inline-block; *display: inline; zoom: 1; vertical-align: top; font-size: 12px;}
#footer1 {width: 25%; background: gray;}
#footer2 {width: 25%; background: gray;}
#footer3 {width: 25%; background: gray;}
#footer4 {width: 25%; background: gray;}
</style>

<div id="container">
    <div id="footer1">
		<h3>About</h3>
		<p>
			Engineering Library is a Hong Kong
			based of information
			service company, which
			provides content and
			tools to help customers
			drive innovation, protect
			their intellectual assets
			and maximize the value
			of their intellectual
			property.
		</p>
	</div>
    <div id="footer2">
		<h3>Contact Us</h3>
	</div>
    <div id="footer3">
		<h3>Publisher</h3><br>
		<h3>Product</h3><br>
		<h3>FAQ</h3><br>
		<h3>Copyright & Permissions</h3><br>
	</div>
    <div id="footer4">Ali</div>
</div>

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