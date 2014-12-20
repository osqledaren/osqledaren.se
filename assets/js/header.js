$(document).ready(function(){
	var currentScroll = 0;
	var headerHeight = $("#header").height();

  $(window).scroll(function(){

  	//If scrolled past header
  	if( headerHeight -  $(this).scrollTop() <=0){ 
  		$("#header").css({position: 'fixed',height:headerHeight},500);
  	}

  	//If scrolled to top of page
  	if ( $(this).scrollTop() <= 0){ 
  		$("#header").css({position:"absolute"});
  	}

  	//If user is at the buttom of the page.
  	if($(window).scrollTop() + $(window).height() == $(document).height()) {
       $("#header").css({position:"fixed",height:headerHeight});
   	}
  	
  });
});
