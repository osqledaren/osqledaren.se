<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package osqledaren
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Inga resultat', 'osqledaren' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'osqledaren' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Hoppsan, det där verkar vi inte ha skrivit något om än. Försök igen.', 'osqledaren' ); ?></p>

		<?php else : ?>

			<p><?php _e( 'Förlåt, men vi kunde inte hitta vad du letar efter. Testa att söka efter det vetja!', 'osqledaren' ); ?></p>
			<!-- <?php get_search_form(); ?> MAX: Tycker detta känns onödigt. Sökrutan finns ändå uppe till höger-->

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
