<?php
/**
 * Loop Meta Template
 *
 * Displays information at the top of the page about archive and search results when viewing those pages.  
 * This is not shown on the home page and singular views.
 *
 * @package dschool
 * @subpackage Template
 */
?>

	<?php if ( is_home() && !is_front_page() ) : ?>

		<?php global $wp_query; ?>

		<h1 class="loop-title"><a href="<?php echo get_post_field( 'permalink', $wp_query->get_queried_object_id() ); ?>" title="<?php echo get_post_field( 'post_title', $wp_query->get_queried_object_id() ); ?>"><?php echo get_post_field( 'post_title', $wp_query->get_queried_object_id() ); ?></a></h1>

	<?php elseif ( is_category() ) : ?>

		<h1 class="loop-title"><span><?php single_cat_title(); ?></span></h1>

	<?php elseif ( is_tag() ) : ?>

		<h1 class="loop-title"><span><?php single_tag_title(); ?></span></h1>

	<?php elseif ( is_tax() ) : ?>

		<h1 class="loop-title"><span><?php single_term_title(); ?></span></h1>

	<?php elseif ( is_author() ) : ?>

		<?php $id = get_query_var( 'author' ); ?>

		<div id="hcard-<?php the_author_meta( 'user_nicename', $id ); ?>" class="loop-meta vcard">

			<h1 class="loop-title fn n"><span><?php the_author_meta( 'display_name', $id ); ?> - Author Archive</span></h1>

			<!--
			<div class="loop-description">
				<?php echo get_avatar( get_the_author_meta( 'user_email', $id ), '100', '', get_the_author_meta( 'display_name', $id ) ); ?>
				<p class="user-bio">
					<?php the_author_meta( 'description', $id ); ?>
				</p>
			</div>.loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_search() ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><span><?php echo esc_attr( get_search_query() ); ?></span></h1>

			<div class="loop-description">
				<p>
				<?php printf( __( 'You are browsing the search results for &quot;%1$s&quot;', hybrid_get_textdomain() ), esc_attr( get_search_query() ) ); ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_date() ) : ?>

		<div class="loop-meta">
			<h1 class="loop-title"><span><?php _e( 'Archives by date', hybrid_get_textdomain() ); ?></span></h1>

			<div class="loop-description">
				<p>
				<?php _e( 'You are browsing the site archives by date.', hybrid_get_textdomain() ); ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_post_type_archive() ) : ?>

		<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>

		<div class="loop-meta">

			<h1 class="loop-title"><span><?php post_type_archive_title(); ?></span></h1>

			<div class="loop-description">
				<?php if ( !empty( $post_type->description ) ) echo "<p>{$post_type->description}</p>"; ?>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_archive() ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><span><?php _e( 'Archives', hybrid_get_textdomain() ); ?></span></h1>

			<div class="loop-description">
				<p>
				<?php _e( 'You are browsing the site archives.', hybrid_get_textdomain() ); ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php endif; ?>