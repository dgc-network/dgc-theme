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
						<div class="footer-payment-icons">
							<div class="fab fa-alipay"></div>
							<div class="alipay-image"></div>
							<div class="wechatpay-image"></div>
							<div class="applepay-image"></div>
							<div class="master-image"></div>
							<div class="visa-image"></div>
							<div class="amex-image"></div>
						</div>
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