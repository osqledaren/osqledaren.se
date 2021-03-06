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

			<?php if (function_exists('osq_adv_get_ad')) osq_adv_get_ad("banner"); ?>

			<ul class="padding unstyled">

			<?php if ( have_posts() ) :
			
			    $exclude_cats = ['fraga-fysikern'];
	
				/* Start the Loop */
				$count = 0;
				while ( have_posts() ) : the_post();
                
					if (in_category($exclude_cats)) continue;
					
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
	
				endwhile;
	
			else :
	
				get_template_part( 'content', 'none' );
	
			endif; ?>
		
			</ul>
		</div><!-- /.row -->
	</div><!-- /#articles -->
	
	<?php osqledaren_paginator(); ?>

<?php get_footer(); ?>
