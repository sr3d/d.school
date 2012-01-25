<?php
/**
 * Template Name: Classes
 *
 * A custom page template for the classes page - it is modification of the subpages template.
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
					
					<?php $post_obj = $wp_query->get_queried_object(); ?>
					
					<div id="<?php echo $post_obj->post_name; ?>" class="<?php hybrid_entry_class(); ?>" name="<?php echo $post_obj->post_name; ?>">

						<?php do_atomic( 'open_entry' ); // dschool_open_entry ?>

						<h1 class="entry-title"><span><?php the_title(); ?></span></h1>

						<?php if (get_post_meta( $post->ID, 'Quote', true )) {echo '<blockquote class="feature-quote">&#8220;' . get_post_meta( $post->ID, 'Quote', true ) . "&#8221;</blockquote>";} ?>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_textdomain() ) ); ?>						
						</div><!-- .entry-content -->

						<div class="feature-container">
						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'full', 'image_class' => 'page-feature', 'link_to_post' => false ) ); ?>
						</div>
						
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>

						<?php do_atomic( 'close_entry' ); // dschool_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // dschool_after_entry ?>

					<?php do_atomic( 'after_singular' ); // dschool_after_singular ?>

				<?php endwhile; ?>

			<?php endif; ?>
		
		<!-- Begin Classes (Subpages) -->
		
		<?php $sub = get_subpages($post->ID); ?>
		
		<?php 
		if($sub) {
		$subarr = split(",",$sub);
		$subarr = array_diff($subarr, array(""));
		$total = count($subarr);
		?>
		
		<?php $temp_query = clone $wp_query; ?>
		
		<?php $counter = 1; ?>
        					
        <?php foreach ( $subarr as $subitem ) { ?>
        					
        <?php query_posts('page_id=' . $subitem); ?>
	
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // dschool_before_entry ?>
					
					<?php $post_obj = $wp_query->get_queried_object(); ?>
					
					<div id="<?php echo $post_obj->post_name; ?>" class="<?php hybrid_entry_class(); ?>" name="<?php echo $post_obj->post_name; ?>">

						<?php do_atomic( 'open_entry' ); // dschool_open_entry ?>

						<h1 class="entry-title"><span><?php the_title(); ?></span></h1>

						<?php if (get_post_meta( $post->ID, 'Quote', true )) {echo '<blockquote class="feature-quote">&#8220;' . get_post_meta( $post->ID, 'Quote', true ) . "&#8221;</blockquote>";} ?>

						<div class="entry-content">
							<!-- <a href="<?php the_permalink(); ?>" title="Go to class website" class="btn-back-class">Go to class website</a>-->
							<?php if (get_post_meta( $post->ID, 'Class Website', true )) {echo '<a href="' . get_post_meta( $post->ID, 'Class Website', true ) . '" title="Go to class website" class="btn-back-class">Go to class website</a>'; }?>
							<?php the_content(); ?>
							<a href="#content" title="Back to class list" class="btn-back-class">Back to class list</a>
						</div><!-- .entry-content -->

						<div class="feature-container">
						<?php 
						if ( current_theme_supports( 'get-the-image' ) ) {
							get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'full', 'image_class' => 'page-feature', 'link_to_post' => false ) ); 
						}
						$vimeoIds = get_post_meta( $post->ID, 'vimeo-id-side', false );
						if($vimeoIds) { 
							if(sizeof($vimeoIds) > 1) {
								$i = 1;
								foreach($vimeoIds as $vimId) {
								?>
								<iframe src="http://player.vimeo.com/video/<?php echo $vimId; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="48.5%" height="267" frameborder="0" style="float:left;margin-bottom:10px;<?php if($i%2) { ?>margin-right:10px;<?php } ?>"></iframe>		
							<?php $i++;
								}	
							}
							else {
								?> <iframe src="http://player.vimeo.com/video/<?php echo get_post_meta( $post->ID, 'vimeo-id-side', true ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="550" frameborder="0"></iframe> <?php
							}
						}
						?>
						</div>
						
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>

						<?php do_atomic( 'close_entry' ); // dschool_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // dschool_after_entry ?>

					<?php do_atomic( 'after_singular' ); // dschool_after_singular ?>

				<?php endwhile; ?>

			<?php endif; ?>
			
			<?php $counter++; ?>
				
           <?php } //end for each sub page ?>
		   
		<?php $wp_query = clone $temp_query; ?>
		
		<?php } //end if have sub pages ?>	
		
		<!-- End Classes (Subpages) -->

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // dschool_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // dschool_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>