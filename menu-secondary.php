<?php
/**
 * Secondary Menu Template
 *
 * Displays the Secondary Menu if it has active menu items.
 *
 * @package dschool
 * @subpackage Template
 */

if ( has_nav_menu( 'secondary' ) ) : ?>

	<?php do_atomic( 'before_menu_secondary' ); // dschool_before_menu_secondary ?>

	<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container' => false ,'container_class' => '', 'menu_class' => '', 'menu_id' => 'banner-links', 'fallback_cb' => '', 'link_before' => '<span>', 'link_after' => '</span>', 'depth' => 1 ) ); ?>

	<?php do_atomic( 'after_menu_secondary' ); // dschool_after_menu_secondary ?>

<?php endif; ?>