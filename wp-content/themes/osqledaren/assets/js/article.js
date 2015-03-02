$('#article .article .content img.alignnone, #article .article .content img.aligncenter').each(function() {
	$(this).wrap('<div class="inline_image_wrap"><div class="inline_image"></div></div>');
});
$(window).on("load resize", function() {
	$('#article .article .content .inline_image_wrap').each(function() {
		var imgHeight = $(this).find('img').height();
		$(this).removeAttr('style');
		$(this).css({height: imgHeight});
	});
});

$('#articles .article .article_image').each(function() {
	$(this).wrap('<div class="image_wrap"></div>');
});
$(window).on("load resize", function() {
	if ( $(window).width() < 768 ) {
		$('#articles .article .image_wrap').each(function() {
			var imgHeight = $(this).find('.article_image').height();
			$(this).removeAttr('style');
			$(this).css({height: imgHeight});
		});
	} else {
		$('#articles .article .image_wrap').removeAttr('style');
	}
});