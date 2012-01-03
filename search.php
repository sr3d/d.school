<?php
/**
 * Search Template
 *
 * The search template is loaded when a visitor uses the search form to search for something
 * on the site.
 *
 * @package dschool
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // dschool_before_content ?>

	<div id="content">
	
		<?php do_atomic( 'open_content' ); // dschool_open_content ?>

		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // dschool_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // dschool_open_entry ?>

						<div class="entry-content">
						
						<ul class="category-list">
						<?php foreach((get_the_category()) as $category) { echo '<li><a href="/category/' . $category->category_nicename . '/" >' . $category->cat_name . '</a></li>'; } ?>
						</ul>
						
							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
							<?php if ($post->post_type == 'post') {?>
							<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[entry-author] <span>|</span> [entry-published] [entry-edit-link before=" <span>|</span> "]', hybrid_get_textdomain() ) . '</div>' ); ?>
							<?php } ?>
							<?php the_excerpt(); ?>
							
							<?php if ($post->post_type == 'post') {?>
							<div class="entry-meta">
							<a href="<?php the_permalink(); ?>#respond" title="Comments"><?php comments_number('Comment', 'Comments (1)', 'Comments (%)'); ?></a> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Permalink</a> <a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4db9efe25b1310bd" title="Share" class="addthis_button">Share</a>
							<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4db9efe25b1310bd"></script>
							</div>
							<?php } ?>


						</div><!-- .entry-summary -->

						<div class="feature-container">
						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'full', 'image_class' => 'page-feature', 'link_to_post' => false ) ); ?>
						</div>

						<?php do_atomic( 'close_entry' ); // dschool_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // dschool_after_entry ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // dschool_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // dschool_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>