<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package dschool
 * @subpackage Functions
 * @version 0.2.0
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2010 - 2011, Jason Conroy
 * @link http://dschool.stanford.edu/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Load the hybrid core theme framework. */
require_once( trailingslashit( TEMPLATEPATH ) . 'hybrid-core/hybrid.php' );
$theme = new Hybrid();

/* Load the dschool core. */
require_once( trailingslashit( TEMPLATEPATH ) . 'dschool-core/dschool-core.php' );
$theme_eex = new DSCHOOLCore();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'dschool_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function dschool_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-post-meta-box' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer', 'about' ) );
	add_theme_support( 'hybrid-core-seo' );
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Add theme support for framework extensions. */
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'cleaner-gallery' );

	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );

	/* Filter the breadcrumb trail arguments. */
	add_filter( 'breadcrumb_trail_args', 'dschool_breadcrumb_trail_args' );

	/* Add the search form to the header. */
	add_action( "{$prefix}_close_header", 'get_search_form' );

	/* Add the logo to the end of the primary menu. */
	add_action( "{$prefix}_close_menu_primary", 'add_small_logo' );	
	
}

/**
 * Add new scripts and remove unused scripts
 *
 */
function dschool_add_remove_scripts(){

   /* Additional Theme JS */
    if (!is_admin()) {
    	 		
 		/* Register Scripts */
 		wp_register_script( 'modernizr', THEME_URI . '/js/modernizr-1.7.min.js','','',false);
 		wp_register_script( 'jquery-cycle', THEME_URI . '/js/jquery.cycle.min.js','','',true);
		wp_register_script( 'jquery-qtip', THEME_URI . '/js/jquery.qtip-1.0.0-rc3.min.js','','',true);
		wp_register_script( 'jquery-hoverintent', THEME_URI . '/js/jquery.hoverIntent.minified.js','','',true);
		
		/* Enqueue Scripts */
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'jquery-cycle' );
		wp_enqueue_script( 'jquery-qtip' );
		wp_enqueue_script( 'jquery-hoverintent' );

	}
}
add_action( 'init', 'dschool_add_remove_scripts', 100 );

/**
 * Custom site title (include logo)
 *
 * @since 0.1.0
 */
function dschool_site_title() {
	$tag = ( is_front_page() ) ? 'h1' : 'div';
	$template_url = get_bloginfo('stylesheet_directory');

	if ( $title = get_bloginfo( 'name' ) )
		$title = '<' . $tag . ' id="site-title"><a href="' . home_url() . '" title="' . esc_attr( $title ) . '" rel="home"><img src="' . $template_url . '/images/logo.png" alt="' . $title . '" /> <span>' . $title . '</span></a></' . $tag . '>';

	echo apply_atomic( 'site_title', $title );
}

/**
 * Displays small dschool logo - used in the navigation
 *
 * @since 0.1.0
 */
function add_small_logo() {
	$template_url = get_bloginfo('stylesheet_directory');
	echo '<a href="/" title="d.school" class="menu-logo"><img src="' . $template_url . '/images/logo-small.png" alt="d.school" /></a>';
}

/**
 * Custom breadcrumb trail arguments.
 *
 * @since 0.1.0
 */
function dschool_breadcrumb_trail_args( $args ) {

	/* Change the text before the breadcrumb trail. */
	$args['before'] = __( '', hybrid_get_textdomain() );

	/* Return the filtered arguments. */
	return $args;
}

/**
 * Function to help with detection of mobile devices
 *
 * @since 0.1.0
 */
function detect_mobile() {
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
		return true;
	}
}

/**
 * Tweaks excerpt 'more' link
 *
 * @since 0.1.0
 */
function new_excerpt_more($more) {
	global $post;
	return '... <br/><a class="readmore" href="'. get_permalink($post->ID) . '">More</a>';
	//return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Get subpages for a given post/page ID
 *
 * @since 0.1.0
 */
function get_subpages($id) {
	global $wpdb;

	$query = $wpdb->prepare("
		SELECT wpposts.ID 
		FROM $wpdb->posts wpposts 
		WHERE wpposts.post_status = 'publish' 
		AND wpposts.post_type = 'page' 
		AND wpposts.post_parent = $id 
		ORDER BY wpposts.menu_order ASC
		");

	$subsarray = $wpdb->get_results($query);

	$subs = '';
	foreach ($subsarray as $sub) {
		$subs .= $sub->ID . ',';
	}
	
	return $subs;
}


?>