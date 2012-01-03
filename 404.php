<?php
/**
 * 404 Template
 *
 * The 404 template is used when a reader visits an invalid URL on your site. By default, the template will 
 * display a generic message.
 *
 * @package dschool
 * @subpackage Template
 * @link http://codex.wordpress.org/Creating_an_Error_404_Page
 */

@header( 'HTTP/1.1 404 Not found', true, 404 );

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // dschool_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // dschool_open_content ?>

		<div class="hfeed">

			<div id="post-0" class="<?php hybrid_entry_class(); ?> singular">

				<h1 class="error-404-title entry-title"><span><?php _e( 'Not Found', hybrid_get_textdomain() ); ?></span></h1>

				<div class="entry-content">

					<img src="/wp-content/themes/dschool/images/error.jpg" alt="404 Error" class="error-image">
					<p>We’re sorry, we couldn’t find the page you’re looking for!</p>
					<p>Please head on to the <a href="/" title="Home">home page</a> or <a href="/about/contact-us/">drop us a line</a> and we'll see if we can help.</p>

				</div><!-- .entry-content -->

			</div><!-- .hentry -->

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // dschool_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // dschool_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>