$(document).ready(function(){

  //FIXED-HEADER SCRIPTS
	var currentScroll = 0;
	var headerHeight = $("#header").height();

  $(window).scroll(function(){
    var scrollDiff = currentScroll - $(this).scrollTop();
    currentScroll = $(this).scrollTop();
    console.log(scrollDiff);

    //When scrolled past breakpoint (Hide the header)
    if( $(this).scrollTop() > headerHeight*2 ){
      if(scrollDiff <= 5){ //Is the user scrolling downwards?
        if(!$("#header").hasClass("slide_up")){
          $("#header").removeClass("slide_down");
          $("#header").addClass("slide_up");
        }
      }
      else if(scrollDiff >5){ //Is the user scrolling upwards at a good enough speed?
        if(!$("#header").hasClass("slide_down")){
          $("#header").removeClass("slide_up");
          $("#header").addClass("slide_down");
        }
      }


    }

    //When user scrolls up toward top
    if($(this).scrollTop() < headerHeight*2){
      $("#header").removeClass("slide_up slide_down");
    }

  	//If user is at the buttom of the page.
  	if($(window).scrollTop() + $(window).height() >= $(document).height()-10) {
      $("#header").removeClass("slide_up");
      if(!$("#header").hasClass("slide_down")){
        $("#header").addClass("slide_down");
      }
   	}
  	


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




});
