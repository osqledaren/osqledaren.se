<?php
/**
 * Template Name: Advertise
 *
 * @package osqledaren
 */

get_header(); ?>

	<article id="advertise" class="page_content container">
		
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
	
	</article><!-- /#about -->
	
	<div id="covers">
		<div class="wrapper">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol141502.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol141501.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol141500.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol131404.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol131403.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol131402.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol131401.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol131400.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol121305.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol121304.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol121303.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol121302.jpg" width="190" height="237">
			<img src="/wp-content/themes/osqledaren/assets/img/covers/ol121301.jpg" width="190" height="237">
		</div>
	</div>

<?php get_footer(); ?>
