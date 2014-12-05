<?php get_template_part('templates/page', 'header'); ?>

	<div class="page-content">
		<p>
			<img src="/assets/img/404/darthv4.6.jpg" alt="">
		</p>
		<h2><?php _e('Please try the following:', 'roots'); ?></h2>
		<ul>
		  <li><?php _e('Check your spelling', 'roots'); ?></li>
		  <li><?php printf(__('Return to the <a href="%s">home page</a>', 'roots'), home_url()); ?></li>
		  <li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'roots'); ?></li>
		</ul>
		<div class="cred-row">
			<div class="cred">
				<span class="cred-line text och foto-cred">
					Illustration<span class="cred-separator">//</span><a href="/om/#karl-bolmgren">Karl Bolmgren</a>
				</span>
			</div>
		</div>
		<hr class="fjong-bottom">
	</div>
</div> <!-- page-wrapper -->