$('#article .article .content img').each( function() {
	var height = $(this).height();
	$(this).wrap('<div class="inline_image_wrap" style="height:' + height + 'px"><div class="inline_image"></div></div>');
});