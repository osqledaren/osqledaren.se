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

	<div id="articles" class="page_content container">
		<div class="row clearfix">
			<div class="padding">
				<?php if ( function_exists('drawAd') ) drawAdsPlace(array('id' => 1), array('before' => '<div class="ad">', 'after' => '</div>')); ?>
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

						if ( $count == 5 ) {
							if ( function_exists('drawAd') ) drawAdsPlace(array('id' => 2), array('before' => '<li class="article inline_ad small noimg"><div class="ad">', 'after' => '</div></li>'));
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
