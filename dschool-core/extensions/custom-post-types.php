<?php
/**
 * The custom post types file creates post types for all custom content required on the dschool website.
 * 
 * For more information on custom post types, see the Codex article here: http://codex.wordpress.org/Post_Types
 *
 * @package dschool
 * @subpackage CPT
 * @version 1.0
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2010 - 2011, Finding Simple
 * @link http://dschool.stanford.edu/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/******************* CREATE Bio POST TYPE ******************/

add_action('init', 'create_bio_type');

function create_bio_type() 
{
  $labels = array(
    'name' => _x('Bios', 'post type general name'),
    'singular_name' => _x('Bio', 'post type singular name'),
    'add_new' => _x('Add New', 'bio'),
    'add_new_item' => __('Add New Bio'),
    'edit_item' => __('Edit Bio'),
    'new_item' => __('New Bio'),
    'view_item' => __('View Bio'),
    'search_items' => __('Search Bios'),
    'not_found' =>  __('No bios found'),
    'not_found_in_trash' => __('No bios found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    '_builtin' => false,
    'capability_type' => 'page',
    'hierarchical' => false,
    'menu_position' => null,
    'taxonomies' => array(),
    'supports' => array('title','editor','thumbnail','excerpt','custom-fields')
  ); 
  register_post_type('bio',$args);
}

add_filter('post_updated_messages', 'bio_updated_messages');

function bio_updated_messages( $messages ) {

  $messages['bio'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Bio updated. <a href="%s">View bio</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Bio updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Bio restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Bio published. <a href="%s">View bio</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Bio saved.'),
    8 => sprintf( __('Bio submitted. <a target="_blank" href="%s">Preview bio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Bio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview bio</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Bio draft updated. <a target="_blank" href="%s">Preview bio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}


/******************* CREATE Student POST TYPE ******************/

add_action('init', 'create_student_type');

function create_student_type() 
{
  $labels = array(
    'name' => _x('Students', 'post type general name'),
    'singular_name' => _x('Student', 'post type singular name'),
    'add_new' => _x('Add New', 'student'),
    'add_new_item' => __('Add New Student'),
    'edit_item' => __('Edit Student'),
    'new_item' => __('New Student'),
    'view_item' => __('View Student'),
    'search_items' => __('Search Students'),
    'not_found' =>  __('No students found'),
    'not_found_in_trash' => __('No students found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    '_builtin' => false,
    'capability_type' => 'page',
    'hierarchical' => false,
    'menu_position' => null,
    'taxonomies' => array(),
    'supports' => array('title','editor','thumbnail','excerpt','custom-fields')
  ); 
  register_post_type('student',$args);
}

add_filter('post_updated_messages', 'student_updated_messages');

function student_updated_messages( $messages ) {

  $messages['student'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Student updated. <a href="%s">View student</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Student updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Student restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Student published. <a href="%s">View student</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Student saved.'),
    8 => sprintf( __('Student submitted. <a target="_blank" href="%s">Preview student</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Student scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview student</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Student draft updated. <a target="_blank" href="%s">Preview student</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

/******************* CREATE PRESS POST TYPE ******************/

add_action('init', 'create_press_type');

function create_press_type() 
{
  $labels = array(
    'name' => _x('Press', 'post type general name'),
    'singular_name' => _x('Press', 'post type singular name'),
    'add_new' => _x('Add New', 'press'),
    'add_new_item' => __('Add New Press Item'),
    'edit_item' => __('Edit Press Item'),
    'new_item' => __('New Press Item'),
    'view_item' => __('View Press Item'),
    'search_items' => __('Search Press'),
    'not_found' =>  __('No press items found'),
    'not_found_in_trash' => __('No press items found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    '_builtin' => false,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'taxonomies' => array(),
    'supports' => array('title','editor','thumbnail','excerpt','custom-fields')
  ); 
  register_post_type('press',$args);
}

add_filter('post_updated_messages', 'press_updated_messages');

function press_updated_messages( $messages ) {

  $messages['press'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Press item updated. <a href="%s">View press item</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Press item updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Press item restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Press item published. <a href="%s">View press item</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Press item saved.'),
    8 => sprintf( __('Press item submitted. <a target="_blank" href="%s">Preview press item</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Press item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview press item</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Press item draft updated. <a target="_blank" href="%s">Preview press item</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

