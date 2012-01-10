<?php
/**
 * The custom meta box file creates custom meta boxes for the dschool website.
 * 
 * For more information on custom meta boxes, see the Codex article here: http://codex.wordpress.org/Function_Reference/add_meta_box
 *
 * @package dschool
 * @subpackage Meta
 * @version 1.0
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2010 - 2011, Finding Simple
 * @link http://dschool.stanford.edu/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

add_action( 'admin_menu', 'meta_box_setup' );

function meta_box_setup() {

	add_meta_box( 'dschool-meta-box', __( 'Dschool Fields:' ), 'dschool_meta_box', 'page', 'normal', 'default' );

	/* Saves the post meta on the page editing page. */
	add_action( 'save_post', 'dschool_save_page', 10, 2 );
	
}

function dschool_meta_box( $post, $box ) { 

	$quote = get_post_meta($post->ID, 'Quote', true);
	
	$class = get_post_meta($post->ID, 'Class Website', true);

?>

	<div class="example">

		<input type="hidden" name="dschool_meta_box_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>" />

	<table class="form-table">

		</tr>
			<tr>
			<th style="width:10%;"><label for="Quote">Quote:</label></th>
			<td><textarea name="Quote" id="Quote" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo $quote; ?></textarea></td>
		</tr>
			<tr>
			<th style="width:10%;"><label for="Class-Website">Class Website:</label></th>
	
			<td><input type="text" name="Class-Website" id="Class-Website" value="<?php echo $class; ?>" size="30" tabindex="30" style="width: 97%;" /></td>
		</tr>
	
	</table><!-- .form-table -->

	</div><?php
}

function dschool_save_page( $post_id, $post ) {

	global $post;

	/* Verify if this is an auto save routine. */
  	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      	return;

	/* Verify the nonce for the meta box. */
	if ( !isset( $_POST['dschool_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['dschool_meta_box_nonce'], basename( __FILE__ ) ) )
		return $post_id;
		
	/* Check permissions */
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return;
	}

	/* Save metadata here. */
	$quote = $_POST['Quote'];
	$class = $_POST['Class-Website'];
	
	update_post_meta( $post_id , 'Quote' , $quote );
	update_post_meta( $post_id , 'Class Website' , $class );
	
}

