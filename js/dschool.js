
/* Menu Dropdown Hover Animation 
=================================*/

jQuery("#menu-primary-items").hoverIntent(makeTall,makeShort);

function makeTall(){ jQuery(this).animate({"height":191},200);}
function makeShort(){ jQuery(this).animate({"height":38},200);}

/* Menu Fading (AMB's Mods) 
==========================*/

jQuery("#menu-primary ul li ul li").fadeTo(50, 0.5);
jQuery("#menu-primary ul li").hover(
	function () {
		jQuery("li", this).fadeTo(100, 1.0);
	}, 
	function () {
    	jQuery("li", this).fadeTo(200, 0.5);
	}
);	

/* Home Banner Slideshow - Requires jQuery Cycle Plugin 
=======================================================*/

var slides = window.winSlides;
var slideDesc = window.winSlideDesc;

if (slides) {
	var totalSlideCount = 2 + slides.length; 
}

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

/* Broader Network Hover Images 
================================*/

jQuery('#network-list li').each(function() {
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
