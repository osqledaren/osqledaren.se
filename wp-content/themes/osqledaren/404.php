<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package osqledaren
 */

get_header(); ?>

	<div class="page_content container">
		<div class="row clearfix">
			<div class="padding">

				<section class="error_404 not_found">
					
					<img src="<?php bloginfo('template_url') ?>/assets/img/404_darth.png" width="740" height="932">
					<p>Vi kan tyvärr inte hitta det du letar efter...kanske du ska testa att söka istället?</p>
					
					<div class="meta">
						<p>Illustration <span class="slash">//</span> Karl Bolmgren</p>
					</div>
	
				</section><!-- .error_404 -->
		
			</div><!-- /.padding -->
		</div><!-- /.row -->
	</div><!-- /#articles -->

<?php get_footer(); ?>
