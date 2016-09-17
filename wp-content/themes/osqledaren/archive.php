<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package osqledaren
 */

get_header();?>

	<div id="articles" class="page_content container">
		<div class="row clearfix">
			<ul class="padding article-list">

			<?php if (have_posts()): ?>

				<h1 class="page_title">
					<?php
the_archive_title('<h1 class="page-title">', '</h1>');
the_archive_description('<div class="taxonomy-description">', '</div>');
?>
				</h1>

				<?php /* Start the Loop */?>
				<?php while (have_posts()): the_post();?>

						<?php
  /* Include the Post-Format-specific template for the content.
   * If you want to override this in a child theme, then include a file
   * called content-___.php (where ___ is the Post Format name) and that will be used instead.
   */
  get_template_part('content', get_post_format());
  ?>

					<?php endwhile;?>

			<?php else: ?>

				<?php get_template_part('content', 'none');?>

			<?php endif;?>

			</ul>
		</div><!-- /.row -->
	</div><!-- /#articles -->

	<?php osqledaren_paginator();?>

<?php get_footer();?>
