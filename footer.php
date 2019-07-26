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
				<a rel="nofollow" href="#top" title="<?php _e('Back to top', 'fruitful'); ?>">&uarr;</a>
			</div>
		</footer><!-- #colophon .site-footer -->
	<!--WordPress Development by dgc-network-->
<?php wp_footer(); ?>
</body>
</html>