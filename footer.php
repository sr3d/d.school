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
	<script type='text/javascript'>

	jQuery("#menu-primary-items").hoverIntent(makeTall,makeShort);
	function makeTall(){  jQuery(this).animate({"height":191},200);}
	function makeShort(){ jQuery(this).animate({"height":38},200);}

 	jQuery('#network-list li').each(function(){
	var img = jQuery(this).attr('id');
	if (img) {
 	jQuery(this).qtip({
   		 content: '<img src="'+ img + '" alt="" height="72" width="94"/>',
   		show: 'mouseover',
   		hide: 'mouseout',
   		 position: {
      		corner: {
         	target: 'rightMiddle',
         	tooltip: 'center'
      	 }
   		}
	});
	}
	});

 	
	</script>
	
	<script type='text/javascript'>
	jQuery("#menu-primary ul li ul li").fadeTo(50, 0.5);
	jQuery("#menu-primary ul li").hover(function () {
    jQuery("li", this).fadeTo(100, 1.0);
  }, 
  function () {
    jQuery("li", this).fadeTo(200, 0.5);
  }
);	
	</script>	
	
	<?php if (is_front_page()) {?>	
	<script type='text/javascript'>

		var slides = window.winSlides;
		var slideDesc = window.winSlideDesc;
		
		var totalSlideCount = 2 + slides.length; 
		
		var slideshow = jQuery('#banner-feature'); 
		
		jQuery('#banner-feature').after('<div id="nav">').cycle({ 
			startingSlide: 0,
			fx:     'fade', 
			speed:  'fast', 
			timeout: 5000, 
			pager:  '#nav',
			slideExpr: '.slide',
			before:   onBefore
		});
		
        function onBefore(curr, next, opts, fwd) { 
            // on Before arguments: 
            //  curr == DOM element for the slide that is currently being displayed 
            //  next == DOM element for the slide that is about to be displayed 
            //  opts == slideshow options 
            //  fwd  == true if cycling forward, false if cycling backward 
                 
            // on the first pass, addSlide is undefined (plugin hasn't yet created the fn yet) 
            if (!opts.addSlide) 
                return; 
            
            // have we added all our slides? 
            if (opts.slideCount == totalSlideCount) 
                return; 
 			
 			while(slides.length) {
 			
				// shift or pop from our slide array  
				var nextSlideSrc = fwd ? slides.shift() : slides.pop(); 
				var nextSlideDesc = fwd ? slideDesc.shift() : slideDesc.pop(); 
				 
				// add our next slide 
				opts.addSlide('<div class="slide" style="background:url('+nextSlideSrc+')" no-repeat scroll top left;"><!-- <span>'+nextSlideDesc+'</span> --></div>', fwd == false); 
            
            }
        }; 
		
	</script>
	<?php } ?>
	<?php if (is_front_page() && !detect_mobile()) {?>	
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