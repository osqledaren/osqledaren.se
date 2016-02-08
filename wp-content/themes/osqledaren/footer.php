<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #main div and all content after
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
			<p class="copy">&copy; <?php echo ( date('Y') == '2008') ? '2008' : '2008-'.date('Y'); ?> Osqledaren</p>
			<p class="cred">Design och utveckling av <a href="https://github.com/osqledaren/osqledaren.se/graphs/contributors">Osqledarens IT-grupper</a></p>
		</div>
	</div>
</footer><!-- /#footer -->

<?php wp_footer(); ?>

</body>
</html>
