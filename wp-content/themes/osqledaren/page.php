<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package osqledaren
 */

get_header(); ?>

	<div id="page" class="page_content container">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<div class="comments">
				<div class="row clearfix">
					<div class="padding clearfix">
						<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>
					</div>
				</div>
			</div><!-- /.comments -->

		<?php endwhile; // end of the loop. ?>

	</div><!-- #page -->

<?php get_footer(); ?>
