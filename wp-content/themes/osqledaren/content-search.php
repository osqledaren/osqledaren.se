<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package osqledaren
 */
 
$post_classes = ' small';
	
if ( has_post_thumbnail() ) {
	$post_classes .= ' righty';
} else {
	$post_classes .= ' noimg';
}

?>

<li id="post-<?php the_ID(); ?>" <?php post_class('article'.$post_classes); ?>>
	<?php if ( get_post_type() == 'post' && has_post_thumbnail() ) : ?>
	<a href="<?php echo get_permalink(); ?>" class="article_image" style="background-image:url(<?php osqledaren_thumbnail(); ?>)">
		<div class="meta">
			<div class="love"></div>
			<p class="time">4 min</p>
		</div><!-- /.meta -->
	</a><!-- /.article_image -->
	<?php endif; ?>

	<div class="article_content">
		<?php if ( get_post_type() == 'post' ) : ?>
		<div class="meta">
			<p class="cat"><?php osqledaren_categories(); ?></p>
			<p class="date"><?php osqledaren_posted_on(); ?></p>
		</div><!-- /.meta -->
		<?php endif; ?>
		
		<div class="excerpt">
			<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="text"><?php the_excerpt(); ?></p>
			<p class="more_link"><a href="<?php echo get_permalink(); ?>">Läs mer</a></p>
		</div><!-- /.excerpt -->
	</div><!-- /.article_content -->
</li><!-- /.article -->