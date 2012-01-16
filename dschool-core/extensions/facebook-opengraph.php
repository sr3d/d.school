<?php 
/**
 * Facebook Opengraph - Adds Facebook open graph meta fields to the theme header.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package FacebookMetaFields
 * @version 0.0.1
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2008 - 2011, Jason Conroy
 * @link http://findingsimple.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

function facebook_meta() {

	$image = get_the_image( array( 'format' => 'array' ) ); 
	$image = $image['url'];
	
	if (!$image)
		$image = "";
	
	?>
<!-- Facebook Meta --> 
<?php if (is_single()) { ?>
<meta property="og:title" content="<?php the_title(); ?>"/>
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink(); ?>"/>
<meta property="og:image" content="<?php echo $image; ?>"/>
<meta property="og:description" content="<?php echo fb_description(); ?>" />
<?php } else { ?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />  
<meta property="og:description" content="<?php echo fb_description(); ?>" />  
<meta property="og:type" content="website" />  
<meta property="og:image" content="<?php echo $image; ?>" /> 
<?php } ?>
<!-- END Facebook Meta -->
<?php

}

add_action('wp_head','facebook_meta');

function fb_description() {

	global $post;
	
	if(!empty($post->post_excerpt)){
		$description = $post->post_excerpt;
	} else {	
		$description = trim(strip_shortcodes(strip_tags($post->post_content)));
		$pos0 = strpos($description, '.')+1;
		$pos0 = ($pos0 === false) ? strlen($description) : $pos0;
		$pos = strpos(substr($description,$pos0),'.');
		if ($pos < 0 || $pos === false) {
			$pos = strlen($description);
		} else {
			$pos = $pos + $pos0;
		}
		$description = str_replace("\n","",substr($description, 0 , $pos));
		$description = str_replace("\r","",$description);
		$description = str_replace("\"","'",$description);
		$description = nl2br($description);
	} 	
	
	if (is_front_page()) {
		$description = get_bloginfo('description');
	}	
	
	return $description;
}

?>