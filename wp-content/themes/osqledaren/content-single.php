<?php
/**
 * @package osqledaren
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
	
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="article_image" style="background-image:url(<?php osqledaren_thumbnail('blurred'); ?>)">
			<div class="overlay">
				<img src="<?php osqledaren_thumbnail(); ?>" />
			</div>
		</div><!-- /.article_image -->
		<?php endif; ?>
		
		<div class="content">
			<div class="row">
				<div class="padding">
						
					<h1><?php the_title(); ?></h1>
					
					<?php the_content(); ?>			
				</div>
			</div>
		</div><!-- /.content -->
		
		<div class="meta">
			<div class="row">
				<div class="padding clearfix">
					<div class="left">
						<?php osqledaren_cred(); ?>
						
						<!-- Text <span class="slash">//</span> Rasmus Jerndal<br>
						Bild <span class="slash">//</span> Sara Edin -->
					</div>
					<div class="right">
						Kategoriserat i <?php osqledaren_categories(); ?><br>
						<span class="date"><?php osqledaren_posted_on(); ?></span>
					</div>
				</div>
			</div>
		</div><!-- /.meta -->

	</article><!-- /.article -->