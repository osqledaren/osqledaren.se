<?php
/**
 * The template for displaying all single posts.
 *
 * @package osqledaren
 */

get_header(); ?>

	<div id="article" class="page_content container">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>
		
			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
	
			<?php osqledaren_next_post(); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- /#article -->

<?php get_footer(); ?>
