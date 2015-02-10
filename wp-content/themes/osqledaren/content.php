<?php
/**
 * @package osqledaren
 */
 
$post_classes = '';

if ( is_home() && !is_paged() && get_query_var('post_number')<=3 ) { // First three posts should be bigger
	$post_classes .= 'big';
	
	if ( has_post_thumbnail() ) {
		if ( get_query_var('post_number')%2 == 0 ) { // Odd posts should be 
			$post_classes .= ' righty';
		} else {
			$post_classes .= ' lefty';
		}
	}
} else {
	$post_classes .= 'small';
	
	if ( has_post_thumbnail() ) {
		$post_classes .= ' righty';
	}
}
if ( !has_post_thumbnail() ) {
	$post_classes .= ' noimg';
}

?>

	<li class="article <?php echo $post_classes; ?>" data-id= "<?php echo get_the_ID(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php echo get_permalink(); ?>" class="article_image" style="background-image:url(<?php osqledaren_thumbnail(); ?>)">
			<div class="meta">
				<div class="love"></div>
				<p class="time"><?php post_read_time(); ?></p> <!-- from the Reading Time Plugin -->
			</div><!-- /.meta -->
		</a><!-- /.article_image -->
		<?php endif; ?>
		
		<div class="article_content">
			<div class="meta">
				<p class="cat"><?php osqledaren_categories(); ?></p>
				<p class="date"><?php osqledaren_posted_on(); ?></p>
			</div><!-- /.meta -->
			
			<div class="excerpt">
				<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="text"><?php the_excerpt(); ?></p>
				<p class="more_link"><a href="<?php echo get_permalink(); ?>">Läs mer</a></p>
			</div><!-- /.excerpt -->
		</div><!-- /.article_content -->
	</li><!-- /.article -->