var $ = require("jquery");

$(document).ready(function(){

    $.fn.snow();

    $('.advent-div').click(function() {
    	if (!$(this).is('.no-click')) {
    		$('.advent-div').removeClass('active');
        	$(this).toggleClass('active');
    	}
        
    });
});


