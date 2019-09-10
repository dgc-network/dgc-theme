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
					<div class="footer-widgets">
						<!-- <div id="sub-footer-widgets"> -->
							<?php
							if ( is_active_sidebar( 'footer-1' ) ) { ?>
								<div class="five columns footer-widget-1">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div>
							<?php }
							if ( is_active_sidebar( 'footer-2' ) ) { ?>
								<div class="five columns footer-widget-2">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div>
							<?php }
							if ( is_active_sidebar( 'footer-3' ) ) { ?>
								<div class="five columns footer-widget-3">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</div>
							<?php } ?>
						<!-- </div> -->
						<div class="one column footer-payment-icons">
							<img class="alipay-icon" src="<?php bloginfo('template_directory');?>/assets/images/alipay.png">
							<img class="wechatpay-icon" src="<?php bloginfo('template_directory');?>/assets/images/wechatpay.png">
							<img class="unionpay-icon" src="<?php bloginfo('template_directory');?>/assets/images/unionpay.png">
							<img class="visa-icon" src="<?php bloginfo('template_directory');?>/assets/images/VISA.png">
							<img class="mastercard-icon" src="<?php bloginfo('template_directory');?>/assets/images/MasterCard.png">
							<!--<div class="fab fa-alipay"></div>
							<div class="fab fa-weixin"></div>
							<div class="fab fa-apple-pay"></div>
							<div class="fab fa-cc-mastercard"></div>
							<div class="fab fa-cc-visa"></div>
							<div class="fab fa-cc-amex"></div>-->
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