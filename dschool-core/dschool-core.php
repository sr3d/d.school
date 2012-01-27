<?php 

class DSCHOOLCore {

	/**
	 * PHP4 constructor method.  This simply provides backwards compatibility for users with setups
	 * on older versions of PHP.  Once WordPress no longer supports PHP4, this method will be removed.
	 *
	 * @since 1.0
	 */
	function DSCHOOLCore() {
		$this->__construct();
	}


	/**
	 * Constructor method for the DSCHOOLCore class.  This method adds other methods of the class to 
	 * specific hooks within WordPress.  It controls the load order.
	 *
	 * @since 1.0
	 */
	function __construct() {

		/* Define DSCHOOLCore constants. */
		add_action( 'after_setup_theme', array( &$this, 'dschool_constants' ), 14 );

		/* Load the DSCHOOLCore extensions. */
		add_action( 'after_setup_theme', array( &$this, 'dschool_extensions' ), 15 );

		/* Load the DSCHOOLCore shortcodes. */
		add_action( 'after_setup_theme', array( &$this, 'dschool_shortcodes' ), 16 );

		/* Load the DSCHOOLCore widgets. */
		add_action( 'after_setup_theme', array( &$this, 'dschool_widgets' ), 17 );

	}

	function dschool_constants() {

		/* Sets the path to the dschool core directory. */
		define( 'DSCHOOL_DIR', trailingslashit( get_template_directory() ) . basename( dirname( __FILE__ ) ) );

		/* Sets the url to the dschool core directory. */
		define( 'DSCHOOL_URL', trailingslashit( get_template_directory_uri() ) . basename( dirname( __FILE__ ) ) );

	}

	function dschool_extensions() {

		/* Setup the DSCHOOL Custom Post Types */
		require_once( DSCHOOL_DIR . '/extensions/custom-post-types.php' );

		/* Setup the DSCHOOL Custom Meta Boxes */
		require_once( DSCHOOL_DIR . '/extensions/custom-meta-boxes.php' );

		/* Setup the DSCHOOL Share Box */
		require_if_theme_supports( 'share-box', DSCHOOL_DIR . '/extensions/share-box.php' );

		/* Add facbook async js */
		require_if_theme_supports( 'facebook-init', DSCHOOL_DIR . '/extensions/facebook-init.php' );

		/* Add facbook opengraph */
		require_if_theme_supports( 'facebook-opengraph', DSCHOOL_DIR . '/extensions/facebook-opengraph.php' );

		/* Add show ids */
		require_if_theme_supports( 'show-ids', DSCHOOL_DIR . '/extensions/show-ids.php' );

	}
	
	function dschool_shortcodes() {

		/* Example call to shortcode file - can be enabled/disabled by child themes */
		//require_if_theme_supports( 'shortcode-columns', DSCHOOL_DIR . '/shortcodes/columns.php' );
				
	}
	
	function dschool_widgets() {

		/* Example call to widgets file - can be enabled/disabled by child themes */
		//require_if_theme_supports( 'widget-featured-articles', DSCHOOL_DIR . '/widgets/featured-articles.php' );
	
	}	

}

/**
 * Replaces WP autop formatting 
 *
 * @since 1.0
 * @author Jason Conroy <jason@findingsimple.com>
 * @package dschool
 */
if (!function_exists( "remove_wpautop")) {
	function remove_wpautop($content) { 
		$content = do_shortcode( shortcode_unautop( $content ) ); 
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}

/**
 * Check if the default sidebar should be displayed. 
 *
 * This is necessary as the footer template includes a get_sidebar call, 
 * but some page templates, such as the page-template-search, do not display
 * the primary/default sidebar and instead use their own sidebar. 
 * 
 * Defaults to false - so the sidebar should not be hidden.
 * 
 * @since 1.0
 * @author Brent Shepherd <brent@findingsimple.com>
 * @package dschool
 */
function dschool_hide_sidebar() {
	if( defined( 'DSCHOOL_HIDE_SIDEBAR' ) )
		return DSCHOOL_HIDE_SIDEBAR;
	else 
		return false;
}


