<?php
/**
 * Front Page Template
 *
 * @package dschool
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>
	
	<?php do_atomic( 'before_content' ); // dschool_before_content ?>
	
	<div id="content">
		
		<?php do_atomic( 'open_content' ); // dschool_open_content ?>

		<div class="hfeed">

			<?php
			
			query_posts('posts_per_page=6&tag=featured&post_type=post&orderby=date&order=DESC');
			$count = 1;
			
			?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // dschool_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>" >

						<?php do_atomic( 'open_entry' ); // dschool_open_entry ?>
						
						<?php
							$category = get_the_category(); 
							echo "<a href='" . get_bloginfo('url') . "/blog/category/" . $category[0]->category_nicename . "/' title='" . $category[0]->cat_name . "' class='home-cat-name'>" . $category[0]->cat_name . "</a> "; 
						?>
						
						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'large', 'image_class' => 'home-thumb' ) ); ?>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->

						<?php do_atomic( 'close_entry' ); // dschool_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // dschool_after_entry ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

			<?php 
			// Reset Query
			wp_reset_query();
			?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // dschool_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // dschool_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>