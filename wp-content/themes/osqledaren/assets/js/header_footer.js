$(document).ready(function() {

	var previousScroll = 0, // previous scroll position
				menuOffset = $("#header").height(), // height of menu (once scroll passed it, menu is hidden)
				detachPoint = 200, // point of detach (after scroll passed it, menu is fixed)
				hideShowOffset = 6,
				$header = $("#header"); // scrolling value after which triggers hide/show menu

		// on scroll hide/show menu
		$(window).scroll(function() {
				var currentScroll = $(this).scrollTop(), // gets current scroll position
						scrollDifference = Math.abs(currentScroll - previousScroll); // calculates how fast user is scrolling

				// if scrolled past menu
				if (currentScroll > menuOffset) {
					// if scrolled past detach point add class to fix menu
					if (currentScroll > detachPoint) {
						if(!$header.hasClass("detached")){
							$header.addClass('detached');
						}
					}

					// if scrolling faster than hideShowOffset hide/show menu
					if (scrollDifference >= hideShowOffset) {
						if (currentScroll > previousScroll) {

							// scrolling down; hide menu
							if( !$header.hasClass("headerHidden")){
								$header.addClass("headerHidden");
								$(".dropdown-menu").slideUp();
								if (! window.location.search){
									$(".search_form").removeClass("selected");
								}
							}
							
						} else {
							// scrolling up; show menu
							if( $header.hasClass("headerHidden")){
								$header.removeClass("headerHidden");
							}
						}
					}
				} else {
					// only remove “detached” class if user is at the top of document (menu jump fix)
					if (currentScroll <= 0){
						$header.removeClass("detached");
					}
				}

				// if user is at the bottom of document show menu
				if ((window.innerHeight + window.scrollY) >= Math.max($(document).height(), $(window).height())) {
					$header.removeClass("headerHidden");
				}

				// replace previous scroll position with new one
				previousScroll = currentScroll;
		});

	//SEARCHBOX-SCRIPTS
	$('.search_form').click(function() {
		if( !$("search_form").hasClass("selected")){
			$(this).addClass("selected");
			$(".search_field").focus();


		}
	});

	//LOGO-SCRIPT
	$("#logo").hover(function() {
		$("#logo #stripe").addClass('loaded');
	});

	//FIX FOR DOUBLE-TAP ISSUE ON IOS
	   $('header#header .go_home').on('click touchend', function() {
	      var el = $(this);
	      var link = el.attr('href');
	      window.location = link;
	   });


	//FOOOTER-SCRIPT
	$(".top").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow",function(){
			$header.removeClass("detached");
			$header.removeClass("headerHidden");
		});
		
	});

	//COLLAPSE-SCRIPT
	$(".collapse-icon").click(function() {
		if ( !$(".dropdown-menu").is(":visible") ) {
			$(".dropdown-menu").slideDown();
		} else {
			$(".dropdown-menu").slideUp();
		}
	});
	
	//IF HEADER AD IS SET
	if ( $(".ad-header").is(":visible") ) {
		$(".page_content").addClass("width_header_ad");
	}

});
