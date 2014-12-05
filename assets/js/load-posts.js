jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(alp.startPage) + 1;
	
	// The maximum number of pages the current query can return.
	var max = parseInt(alp.maxPages);
	
	// The link of the next page of posts.
	var nextLink = alp.nextLink;
	
	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(pageNum <= max) {
		// Remove the traditional navigation.
		$('.pager').remove();

		// Insert the "More Posts" link.
		$('#main')
			.append('<div class="alp-placeholder-'+ pageNum +'"></div>')
			.append('<nav id="load-more" class="pager"><a href="#"><span class="load-more-icon">&#xe00d;</span><span class="load-more-text">Fler inlägg</span></a></nav>');
	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */
	$('#load-more a').click(function() {
	
		// Are there more posts to load?
		if(pageNum <= max && !$('#load-more .load-more-icon').hasClass('loading')) {
		
			// Show that we're working.
			$('#load-more .load-more-text').text('Laddar inlägg...');
			$('#load-more .load-more-icon').toggleClass('loading');
			$('#load-more .load-more-icon').html('&#xe00f;');
			
			$('.alp-placeholder-'+ pageNum).hide();
			$('.alp-placeholder-'+ pageNum).load(nextLink + ' .post',
				function() {
					$('.alp-placeholder-'+ pageNum).fadeIn();

					// Update URL using history API
					history.pushState(null, null, nextLink);

					// Update page number and nextLink.
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]*/, '/page/'+ pageNum);
					
					// Add a new placeholder, for when user clicks again.
					$('#load-more').before('<div class="alp-placeholder-'+ pageNum +'"></div>')
					
					// Update the button message.
					if(pageNum <= max) {
						$('#load-more .load-more-text').text('Fler inlägg');
					} else {
						$('#load-more .load-more-text').text('Det finns inga fler inlägg.');
						$('#load-more .load-more-icon').hide();
						$('#load-more a').addClass('load-more-disabled');
					}

					$('#load-more .load-more-icon').toggleClass('loading');
					$('#load-more .load-more-icon').html('&#xe00d;');
				}
			);
		}
		
		return false;
	});
});