$('#article .article .content img.alignnone, #article .article .content img.aligncenter').each( function() {
	var height = $(this).height();
	$(this).wrap('<div class="inline_image_wrap" style="height:' + height + 'px"><div class="inline_image"></div></div>');
});