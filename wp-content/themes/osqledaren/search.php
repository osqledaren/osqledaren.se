<?php
/**
 * The template for displaying search results pages.
 *
 * @package osqledaren
 */

get_header(); ?>

	<div id="articles" class="page_content container">
		<div class="row clearfix">
			<ul class="padding">

			<?php if ( have_posts() ) : ?>
	
				<h1 class="page_title">Sökresultat för: <?php echo get_search_query(); ?></h1>
	
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
	
					<?php
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'content', 'search' );
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
