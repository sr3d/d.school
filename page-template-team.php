<?php
/**
 * Template Name: Team
 *
 * A custom page template for the team page.
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

						<h1 class="entry-title"><span><?php the_title(); ?></span></h1>

						<?php if (get_post_meta( $post->ID, 'Quote', true )) {echo '<blockquote class="feature-quote">&#8220;' . get_post_meta( $post->ID, 'Quote', true ) . "&#8221;</blockquote>";} ?>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_textdomain() ) ); ?>
						</div><!-- .entry-content -->

						<div class="team-right">
							<h2>Who’s here in 2010-2011</h2>
							
							<ul id="current-team-list">
							<?php $temp_query = clone $wp_query; ?>
							
							<?php $counter = 1; ?>
												
							<?php query_posts('post_type=bio&orderby=title&order=ASC&posts_per_page=-1'); ?>
						
								<?php if ( have_posts() ) : ?>
					
									<?php while ( have_posts() ) : the_post(); ?>
					
									<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_post_meta( $post->ID, 'bio-thumb', true ); ?>" alt="<?php the_title();?>" /><span>
									<?php 
									if (get_post_meta( $post->ID, 'name-special', true )) {
									echo get_post_meta( $post->ID, 'name-special', true );
									} else {
									echo str_replace(' ', '<br />' , get_the_title()); 
									}
									?>
									</span></a></li>
				
									<?php endwhile; ?>
					
								<?php endif; ?>
								
								<?php $counter++; ?>
							   
							<?php $wp_query = clone $temp_query; ?>
							<?php wp_reset_query(); ?> 
							</ul>
							
							<div style="clear:both;"></div>
							
							<div id="network-list">
							<h2>Our Broader Network</h2>
							<p>These superstars have been a part of our teaching teams, fellows, staff or founding team. They continue to do amazing work at Stanford and in the world.</p>
							<ul>
							<?php //echo strip_tags(preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a>@i', '<li$1><a$2><span>$3</span></a>', wp_list_bookmarks('category=47&title_li=&categorize=0&echo=0&orderby=name&order=asc&show_images=0') ),'<li>'  ); ?>
							<?php
							$links = get_bookmarks( array('category' => 47) );
							foreach ( $links AS $link ) {
							echo '<li id="' . $link->link_image .'">' . $link->link_name . "</li>";
							}
							?>
							</ul>
							</div>

						</div>
						
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>

						<?php do_atomic( 'close_entry' ); // dschool_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // dschool_after_entry ?>

					<?php do_atomic( 'after_singular' ); // dschool_after_singular ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // dschool_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // dschool_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>