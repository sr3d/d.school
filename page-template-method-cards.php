<?php
/**
 * Template Name: Method Cards
 *
 * A custom page template that displays method cards.
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

						<div class="method-right">
							<h2>Get Started</h2>
							
							<ul id="method-list">
								<li><a href="/wp-content/themes/dschool/method-cards/what-why-how.pdf" title="What? | How? | Why?"><img src="/wp-content/themes/dschool/method-cards/what-why-how-thumb.jpg" alt="What? | How? | Why?" /><span>What? How? <br/>Why?</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/interview-preparation.pdf" title="Interview Preparation"><img src="/wp-content/themes/dschool/method-cards/interview-preparation-thumb.jpg" alt="Interview Preparation" /><span>Interview <br/>Preparation</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/interview-for-empathy.pdf" title="Interview for Empathy"><img src="/wp-content/themes/dschool/method-cards/interview-for-empathy-thumb.jpg" alt="Interview for Empathy" /><span>Interview <br/>for Empathy</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/extreme-users.pdf" title="Extreme Users"><img src="/wp-content/themes/dschool/method-cards/extreme-users-thumb.jpg" alt="Extreme Users" /><span>Extreme <br/>Users</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/saturate-and-group.pdf" title="Saturate and Group"><img src="/wp-content/themes/dschool/method-cards/saturate-and-group-thumb.jpg" alt="Saturate and Group" /><span>Saturate <br/>and Group</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/empathy-map.pdf" title="Empathy Map"><img src="/wp-content/themes/dschool/method-cards/empathy-map-thumb.jpg" alt="Empathy Map" /><span>Empathy <br/>Map</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/why-how-laddering.pdf" title="Why-How Laddering"><img src="/wp-content/themes/dschool/method-cards/why-how-laddering-thumb.jpg" alt="Why-How Laddering" /><span>Why-How <br/>Laddering</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/point-of-view-madlib.pdf" title="Point-of-View Madlib"><img src="/wp-content/themes/dschool/method-cards/point-of-view-madlib-thumb.jpg" alt="Point-of-View Madlib" /><span>Point-of-View <br/>Madlib</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/stoke.pdf" title="Stoke"><img src="/wp-content/themes/dschool/method-cards/stoke-thumb.jpg" alt="Stoke" /><span>Stoke</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/brainstorm-rules.pdf" title="Brainstorming"><img src="/wp-content/themes/dschool/method-cards/blank.jpg" alt="Brainstorming" /><span>Brainstorming</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/facilitate-a-brainstorm.pdf" title="Facilitate a Brainstorm"><img src="/wp-content/themes/dschool/method-cards/facilitate-a-brainstorm-thumb.jpg" alt="Facilitate a Brainstorm" /><span>Facilitate a <br/>Brainstorm</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/selection.pdf" title="Selection"><img src="/wp-content/themes/dschool/method-cards/selection-thumb.jpg" alt="Selection" /><span>Selection</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/prototype-for-empathy.pdf" title="Prototype for Empathy"><img src="/wp-content/themes/dschool/method-cards/prototype-for-empathy-thumb.jpg" alt="Prototype for Empathy" /><span>Prototype for <br />Empathy</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/prototype-to-test.pdf" title="Prototype to Test"><img src="/wp-content/themes/dschool/method-cards/prototype-to-test-thumb.jpg" alt="Prototype to Test" /><span>Prototype to <br/>Test</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/storytelling.pdf" title="Storytelling"><img src="/wp-content/themes/dschool/method-cards/storytelling-thumb.jpg" alt="Storytelling" /><span>Storytelling</span></a></li>
								<li><a href="/wp-content/themes/dschool/method-cards/i-like-i-wish-what-if.pdf" title="I Like, I Wish, What If"><img src="/wp-content/themes/dschool/method-cards/i-like-i-wish-what-if-thumb.jpg" alt="I Like, I Wish, What If" /><span>I Like, I Wish, <br/>What If</span></a></li>
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