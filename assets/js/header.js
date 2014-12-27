$(document).ready(function(){

  //FIXED-HEADER SCRIPTS
	var currentScroll = 0;
	var headerHeight = $("#header").height();

  $(window).scroll(function(){

  	//If scrolled past header
  	if( headerHeight -  $(this).scrollTop() <=0){ 
  		$("#header").css({"position": 'fixed',"top":-1*headerHeight+"px"},500);
      console.log("Hej");
  	}

  	//If scrolled to top of page
  	if ( $(this).scrollTop() <= 0){ 
  		$("#header").css({position:"absolute"});
  	}

  	//If user is at the buttom of the page.
  	if($(window).scrollTop() + $(window).height() == $(document).height()) {
       $("#header").css({position:"fixed"});
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
