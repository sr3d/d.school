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

function quote_meta($meta) {
	
	$domain = hybrid_get_textdomain();

	$meta['quote'] = array( 'name' => 'Quote', 'title' => __( 'Quote:', $domain ), 'type' => 'textarea' );
	return $meta;
}

function class_meta($meta) {
	
	$domain = hybrid_get_textdomain();

	$meta['class-website'] = array( 'name' => 'Class Website', 'title' => __( 'Class Website:', $domain ), 'type' => 'text' );
	return $meta;
}

