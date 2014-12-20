
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/js/everything-min.js"></script> <!-- Compiled libraries JS-->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="./assets/js/header.js"></script> <!-- denna hör till headern. (Men vill inte blocka DOM-load med Javascript.) -->
<script type="text/javascript" src="./assets/js/footer.js"></script> <!-- Footerns javascript -->
<script type="text/x-handlebars-template">
	</script>



<script type="text/javascript">
$('.search_icon').click(function() {
	if ( !$('.search_field').is(':visible') ) {
		/* Display the search field */
		$('.search_icon').animate({right: '13'}, 500);
		$('.search_field').show('slide', { direction: 'right' }, 500);	
	}
});
$('body').click(function(evt){    
	/* Hide form when anywhere in body (except search form) is clicked */
	if ( evt.target.class == 'search_form' )
	return;
	if( $(evt.target).closest('.search_form').length )
	return;
	
	/* Hide the search field */  
	if ( $('.search_field').is(':visible') ) {
		$('.search_icon').animate({right: '0'}, 500);
		$('.search_field').hide('slide', { direction: 'right' }, 500);
	}
});


$("#logo").hover(function() {
	$("#logo #stripe").addClass('loaded');
});
</script>