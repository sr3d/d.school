<?php
/**
 * Template Name: Student
 *
 * A custom page template to display student post types.
 *
 * @package dschool
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // dschool_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // dschool_open_content ?>

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // dschool_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // dschool_open_entry ?>

						<h1 class="page-title entry-title"><span>Student Stories</span></h1>
						<blockquote class="feature-quote">Stories from the students who have gone through the d.school experience.</blockquote>
						
						<div class="entry-content">
							<h2><?php the_title(); ?></h2>
							
								<?php if (get_post_meta( $post->ID, 'vimeo-id', true )) { ?>
								<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta( $post->ID, 'vimeo-id', true ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="350" height="190" frameborder="0"></iframe>
								<?php } else { ?>
								<?php if ( current_theme_supports( 'get-the-image' ) ) { 
									$imgarr = get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'full', 'image_class' => 'student-top', 'link_to_post' => false, 'format' => 'array' ) );
									echo '<a href="' . $imgarr["src"] . '" title="" rel="lightbox" class="student-top"/>';
									get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'full', 'image_class' => 'student-top-img', 'link_to_post' => false ) ); 
									echo "</a>";	
								} ?>
								<?php } ?>							
								<?php if (get_post_meta( $post->ID, 'student-title', true )) {echo '<p class="student-title">' . get_post_meta( $post->ID, 'student-title', true ) . "</p>";} ?>

							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_textdomain() ) ); ?>
						</div><!-- .entry-content -->

						<div class="student-right">
							<h2>Alumni</h2>

							<ul id="student-list">
							<?php $temp_query = clone $wp_query; ?>
							
							<?php $counter = 1; ?>
												
							<?php query_posts('post_type=student&orderby=title&order=ASC&posts_per_page=-1'); ?>
						
								<?php if ( have_posts() ) : ?>
					
									<?php while ( have_posts() ) : the_post(); ?>
					
									<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_post_meta( $post->ID, 'student-thumb', true ); ?>" alt="<?php the_title();?>" /><span><?php echo str_replace(' ', '<br />' , get_the_title()); ?></span></a></li>
				
									<?php endwhile; ?>
					
								<?php endif; ?>
								
								<?php $counter++; ?>
							   
							<?php $wp_query = clone $temp_query; ?>	
							<?php wp_reset_query(); ?> 
							
							</ul>

						</div>
						
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>

						<?php do_atomic( 'close_entry' ); // dschool_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // dschool_after_entry ?>

					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php do_atomic( 'after_singular' ); // dschool_after_singular ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // dschool_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // dschool_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>