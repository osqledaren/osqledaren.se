<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package osqledaren
 */

get_header();

?>

<div id="articles" class="page_content container">
	<div class="row clearfix">

		<ul class="padding article-list">

		<?php if (have_posts()): ?>

			<h1 class="page_title">Pods</h1>

      <p class="podcast-feed-url"><a class="podcast-feed-url-link" title="Prenumerera på våra poddar" href="<?php echo get_site_url() . '/feed/podcast'; ?>">Prenumerera på våra poddar</a></p>

      <?php the_archive_description('<div class="taxonomy-description">', '</div>');?>

			<?php while (have_posts()): the_post();?>
						      <?php get_template_part('content', 'podcast');?>
						    <?php endwhile;?>

		<?php else: ?>

			<?php get_template_part('content', 'none');?>

		<?php endif;?>

		</ul>
	</div><!-- /.row -->
</div><!-- /#articles -->

<?php osqledaren_paginator();?>

<?php get_footer();?>
