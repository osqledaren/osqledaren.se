$(window).on("load resize", function() {
	$('#covers .wrapper').css({
		width: $(window).width() + $('#covers img').width()
	});
});