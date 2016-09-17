<?php
/**
 * @package osqledaren
 */
?>
	<style type="text/css">
	/* Hides first image if it's the same as thumbnail */
	#article .article .content .padding .article_title + p img.wp-image-<?php echo get_post_thumbnail_id(); ?>,
	#article .article .content .padding .article_title + h1 img.wp-image-<?php echo get_post_thumbnail_id(); ?>,
	#article .article .content .padding .article_title + h2 img.wp-image-<?php echo get_post_thumbnail_id(); ?>,
	#article .article .content .padding .article_title + h3 img.wp-image-<?php echo get_post_thumbnail_id(); ?>,
	#article .article .content .padding .article_title + h4 img.wp-image-<?php echo get_post_thumbnail_id(); ?>,
	#article .article .content .padding .article_title + h5 img.wp-image-<?php echo get_post_thumbnail_id(); ?>,
	#article .article .content .padding .article_title + h6 img.wp-image-<?php echo get_post_thumbnail_id(); ?> {
		display: none;
		visibility: hidden;
		width: 0 !important;
		height: 0 !important;
	}
	</style>

	<article id="post-<?php the_ID();?>" <?php post_class('article');?>>

		<?php if (has_post_thumbnail()): ?>
		<div class="article_image" style="background-image:url(<?php osqledaren_thumbnail('blurred');?>)">
			<div class="overlay">
				<img src="<?php osqledaren_thumbnail('large');?>" />
			</div>
		</div><!-- /.article_image -->
		<?php endif;?>

		<div class="content">
			<div class="row">
				<div class="padding">
					<h1 class="article_title"><?php the_title();?></h1>

					<?php
/*
function first_three_words($content){
$paragraphs = explode("\n", $content);
foreach($paragraphs as $paragraph) {
$first = implode(' ', array_slice(explode(' ', $paragraph), 0, 3));
$first = '<strong>' . $first . '</strong>';

echo $first . ' ';

$string = explode (' ', $paragraph, 4);
$string = $string[3];

echo $string;
}
}
add_filter('the_content', 'first_three_words');
 */
?>

					<?php the_content();?>
				</div>
			</div>
		</div><!-- /.content -->

		<div class="meta">
			<div class="row">
				<div class="padding clearfix">
					<div class="left">
						<?php osqledaren_cred();?>
            <p class="podcast-series-list-label">Podcast series:&nbsp;</p><?php the_podcast_series();?>
					</div>
					<div class="right">

						<span class="date"><?php osqledaren_posted_on();?></span>
					</div>
				</div>
			</div>
		</div><!-- /.meta -->

	</article><!-- /.article -->
