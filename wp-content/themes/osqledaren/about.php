<?php
/**
 * Template Name: About
 *
 * @package osqledaren
 */

get_header(); ?>

	<article id="about" class="page_content container">
		
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="content">
				<div class="row">
					<div class="padding">
							
						<h1><?php the_title(); ?></h1>
						
						<?php the_content(); ?>	
					</div>
				</div>
			</div><!-- /.content -->
		<?php endwhile; ?>
		
		<!-- <div id="image" style="background-image:url(<?php echo bloginfo( 'template_url' ); ?>/assets/img/redaktions_selfie_blurry.jpg)"> -->
		<div id="about-image">
			<img src="<?php echo bloginfo( 'template_url' ); ?>/assets/img/redaktions_selfie.jpg" width="1140" height="675">
		</div><!-- /.article_image -->
	
	</article><!-- /#about -->

<?php get_footer(); ?>
