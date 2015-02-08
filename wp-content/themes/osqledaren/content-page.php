<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package osqledaren
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content">
		<div class="row">
			<div class="padding">
				<h1><?php the_title(); ?></h1>
				
				<?php the_content(); ?>			
			</div>
		</div>
	</div><!-- /.content -->
</article><!-- #post-## -->
