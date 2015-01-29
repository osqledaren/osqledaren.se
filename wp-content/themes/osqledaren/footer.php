<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package osqledaren
 */
?>
		
</div><!-- /#main -->

<footer id="footer" class="container">
	<div class="row">
		<div class="padding">			
			<div class="top"></div>
			
			<p class="tagline">Producerad med <span class="accent">kärlek</span> på <a href="http://www.kth.se/">KTH</a></p>
			<p class="copy">&copy; <?php echo date('Y'); ?> Osqledaren</p>
			<p class="cred">Design och utveckling av <a href="http://www.nicolasdesignhouse.com">Nicolas</a> och <a href="#">Max</a></p>
		</div>
	</div>
</footer><!-- /#footer -->

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/everything-min.js"></script> <!-- jQuery, Underscore, Backbone, Handlebars Minified -->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/header_footer.js"></script> <!-- Header AND footer Javascript -->

<?php wp_footer(); ?>

</body>
</html>