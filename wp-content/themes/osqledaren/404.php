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
					<h1 class="page_title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'osqledaren' ); ?></h1>
	
					<div class="content">
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'osqledaren' ); ?></p>
	
						<?php get_search_form(); ?>
	
						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
	
						<?php if ( osqledaren_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
						<div class="widget widget_categories">
							<h2 class="widget-title"><?php _e( 'Most Used Categories', 'osqledaren' ); ?></h2>
							<ul>
							<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								) );
							?>
							</ul>
						</div><!-- .widget -->
						<?php endif; ?>
	
						<?php
							/* translators: %1$s: smiley */
							$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'osqledaren' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
						?>
	
						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
	
					</div><!-- .page-content -->
				</section><!-- .error-404 -->
		
			</div><!-- /.padding -->
		</div><!-- /.row -->
	</div><!-- /#articles -->

<?php get_footer(); ?>
