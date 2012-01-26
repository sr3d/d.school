<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package dschool
 * @subpackage Template
 */
?>
				<?php if (is_front_page()) {?>

				<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

				<?php } ?>

				<?php do_atomic( 'close_main' ); // dschool_close_main ?>

			</div><!-- .wrap -->

		</div><!-- #main -->

		<?php do_atomic( 'after_main' ); // dschool_after_main ?>

		<?php do_atomic( 'before_footer' ); // dschool_before_footer ?>

		<div id="footer">

			<?php do_atomic( 'open_footer' ); // dschool_open_footer ?>

			<div class="wrap">

				<?php echo apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) ); ?>

				<?php do_atomic( 'footer' ); // dschool_footer ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_footer' ); // dschool_close_footer ?>

		</div><!-- #footer -->

		<?php do_atomic( 'after_footer' ); // dschool_after_footer ?>

	</div><!-- #container -->

	<?php do_atomic( 'close_body' ); // dschool_close_body ?>
	
	<?php wp_footer(); // wp_footer ?>
	
	<?php 
	
	/* Pin the menu to top of the browser window on scroll*/
	
	if (is_front_page() && !detect_mobile()) { ?>	
	<script type='text/javascript'>
	
	function moveScroller() {
	
  		var a = function() {
    	var b = jQuery(window).scrollTop();
    	var d = jQuery("#scroller-anchor").offset().top;
    	var c = jQuery(".home #menu-primary");
    	
    	if (b>d) {
      		c.css({position:"fixed",top:"0px"})
    	} else {
      		if (b<=d) {
        		c.css({position:"relative",top:""})
      		}
    	}
  	};
  	
  	jQuery(window).scroll(a);a()}
	jQuery(function() {moveScroller();});
	
	</script>
	
	<?php } ?>
</body>
</html>