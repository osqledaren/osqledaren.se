<footer id="content-info" class="container" role="contentinfo">
  <?php //dynamic_sidebar('sidebar-footer'); ?>
  <ul class="footer-links">
  	<li>
	  	<ul class="iconlinks">
		  	<li><a href="http://www.facebook.com/osqledaren" title="Osqledarens Facebook sida" class="icon facebook"></a></li>
		  	<li><a href="https://twitter.com/osqledaren" title="@Osqledaren" class="icon twitter"></a></li>
		  	<li><a href="http://instagram.com/osqledaren/" title="Osqledaren på Instagram" class="icon instagram"></a></li>
		  	<li><a href="/feed/" title="RSS Feed" class="icon feed"></a></li>
	  	</ul>
	</li>
	<li>
	  	<ul class="otherlinks">
		  	<li><a href="/arkiv" title="Arkiv">Arkiv</a></li>
		  	<li><a href="/kontakt/" title="Kontakt & info">Kontakt</a></li>
		  	<li><a href="/annonsera/" title="Kontakt & info">Annonsera</a></li>
		  	<li><a href="http://ths.kth.se" title="Tekniska Högskolans Studentkår">THS</a></li>
		</ul>
	</li>
  </ul>
  <p class="copyright"><strong>&copy;</strong> <?php echo date('Y'); ?> <?php bloginfo('name'); ?>, Designad av <a href="http://gergeo.se">Nadan Gergeo</a> &amp; Axel Hammarbäck.</p>
</footer>

<?php wp_footer(); ?>