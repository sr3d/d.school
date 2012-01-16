<?php 
/**
 * Share Box - Adds social share box to singular post types.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package ShareBox
 * @version 0.0.1
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2008 - 2011, Jason Conroy
 * @link http://findingsimple.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Get action/filter hook prefix. */
$prefix = hybrid_get_prefix();

function sharebox_insert_html() {

	if (is_single() && ('post' == get_post_type()) ) { ?>
<ul id="sharebox">
	<li><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="vertical"></a></li>
	<li><fb:like layout="box_count" show_faces="false" href="<?php echo urlencode(get_permalink()); ?>" width="50"></fb:like></li>
	<li><g:plusone size="tall" href="<?php the_permalink(); ?>"></g:plusone></li>
</ul>
<?php }
}

add_action( "{$prefix}_open_entry", 'sharebox_insert_html' );


?>