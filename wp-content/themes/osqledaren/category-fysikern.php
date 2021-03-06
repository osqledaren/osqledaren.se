<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package osqledaren
 */

get_header(); ?>

	<div id="articles" class="fraga_fysikern page_content container">
		<div class="row clearfix">
				
			<div id="fraga_fysikern_header" class="padding">
				<img src="<?php echo bloginfo('template_url'); ?>/assets/img/fraga_fysikern/fraga_fysikern_header.jpg" width="1140" height="469" />
			</div>

			<ul class="padding unstyled">

			<?php if ( have_posts() ) : ?>
	
				<?php /* Start the Loop */ ?>
				<?php $count = 0; ?>
				<?php while ( have_posts() ) : the_post(); ?>
	
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						$count++;

						if ( $count == 5 && function_exists('osq_adv_get_ad') ) {
							osq_adv_get_ad("articles");
						}
						set_query_var( 'post_number', $count );
						get_template_part( 'content', get_post_format() );
					?>
	
				<?php endwhile; ?>
	
			<?php else : ?>
	
				<?php get_template_part( 'content', 'none' ); ?>
	
			<?php endif; ?>
		
			</ul>
		</div><!-- /.row -->
	</div><!-- /#articles -->
	
	<?php osqledaren_paginator(); ?>

<?php get_footer(); ?>