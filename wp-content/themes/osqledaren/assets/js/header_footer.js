$(document).ready(function(){

  //FIXED-HEADER SCRIPTS
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
          }

          // if scrolling faster than hideShowOffset hide/show menu
          if (scrollDifference >= hideShowOffset) {
            if (currentScroll > previousScroll) {

              // scrolling down; hide menu
              	$("#header").addClass("headerHidden");
              
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
  $('.search_icon').click(function() {
  if ( !$('.search_field').is(':visible') ) {
    /* Display the search field */
    $('.search_icon').animate({right: '13'}, 500);
    $('.search_field').show('slide', { direction: 'right' }, 500);  
  }
});
$('body').click(function(evt){    
  /* Hide form when anywhere in body (except search form) is clicked */
  if ( evt.target.class === 'search_form' ){
  	return;
  }
  if( $(evt.target).closest('.search_form').length ){
  	return;
  }
  
  /* Hide the search field */  
  if ( $('.search_field').is(':visible') ) {
    $('.search_icon').animate({right: '0'}, 500);
    $('.search_field').hide('slide', { direction: 'right' }, 500);
  }
});

//LOGO-SCRIPT
$("#logo").hover(function() {
  $("#logo #stripe").addClass('loaded');
});


 //FOOOTER-SCRIPT
  $(".top").click(function(){
    $("html, body").animate({ scrollTop: 0 }, "slow");
    
  })


});
