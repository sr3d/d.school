<?php
/**
 * Shortcode List Posts - Shortcode for listing posts based on category and tag. Created for the dmedia site.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package ShortcodeListPosts
 * @version 0.0.1
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2008 - 2012, Jason Conroy
 * @link http://findingsimple.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
/*

Optional arguments:
 - posts_per_page: 
 - cat:
 - tag:
 - order:
 - order_by:
 
*/
function shortcode_list_posts($atts, $content = null) {
	
   	extract(shortcode_atts(array(	'posts_per_page' => -1 ,
   	   								'cat' => '',
   	   								'tag' => '',
   									'order' => '',
   									'order_by' => '' 
   									), $atts));
	
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $posts_per_page,
		'post_status' => 'publish'
	);

	if (!empty($cat)) {
		$cat = split(',' , str_replace (" ", "", $cat) );
		$args['category__and'] = $cat;
	}
	
	if(!empty($tag)) {
		$tag = split(',' , str_replace (" ", "", $tag) );
		$args['tag__in'] = $tag;
	}
	
	if ($order) {
		$args['order'] = $order;
	}
	
	if ($order_by) {
		$args['orderby'] = $order_by;
	}
		
	$my_query = new WP_Query();
	$my_query->query($args); 
	
	$content = '<ul class="post-list" >';

	while ($my_query->have_posts()) : $my_query->the_post();	
		
		$author = get_the_author_meta('display_name');
		$author_url = get_author_posts_url(get_the_author_meta( 'ID' ));
		
		$content .= '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a> <span>- by <a href="' . $author_url . '" title="' . $author . '">' . $author . '</a> on ' . get_the_time('F j, Y') . '</span></li>'. "\n";

	endwhile;
	
	$content .= '</ul><!-- end .post-list -->';
	
	//wp_reset_query();

	return remove_wpautop($content);

}

add_shortcode( 'list-posts', 'shortcode_list_posts' );

?>