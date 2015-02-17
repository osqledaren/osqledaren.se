$(document).ready(function(){

	var previousScroll = 0, // previous scroll position
				menuOffset = $("#header").height(), // height of menu (once scroll passed it, menu is hidden)
				detachPoint = 200, // point of detach (after scroll passed it, menu is fixed)
				hideShowOffset = 6; // scrolling value after which triggers hide/show menu

		// on scroll hide/show menu
		$(window).scroll(function() {
				var currentScroll = $(this).scrollTop(), // gets current scroll position
						scrollDifference = Math.abs(currentScroll - previousScroll); // calculates how fast user is scrolling

				// if scrolled past menu
				if (currentScroll > menuOffset) {
					// if scrolled past detach point add class to fix menu
					if (currentScroll > detachPoint) {
						$("#header").addClass('detached');
						$(".dropdown-menu").addClass("hidden");
					}

					// if scrolling faster than hideShowOffset hide/show menu
					if (scrollDifference >= hideShowOffset) {
						if (currentScroll > previousScroll) {

							// scrolling down; hide menu
								$("#header").addClass("headerHidden");
								if (! window.location.search){
									$(".search_form").removeClass("selected");
								}
							
						} else {
							// scrolling up; show menu
								$("#header").removeClass("headerHidden");
						}
					}
				} else {
					// only remove “detached” class if user is at the top of document (menu jump fix)
					if (currentScroll <= 0){
						$("#header").removeClass("detached");
					}
				}

				// if user is at the bottom of document show menu
				if ((window.innerHeight + window.scrollY) >= Math.max($(document).height(), $(window).height())) {
					$("#header").removeClass("headerHidden");
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



 //FOOOTER-SCRIPT
	$(".top").click(function(){
		$("html, body").animate({ scrollTop: 0 }, "slow");
		
	});

	//Collapse-script

	$(".collapse-icon").click(function(){
		$(".dropdown-menu").toggleClass("hidden");
	});

});
