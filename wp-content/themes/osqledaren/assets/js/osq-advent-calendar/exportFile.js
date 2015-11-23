var $ = require("jquery");

$(document).ready(function(){

    $('.advent-div').click(function() {
    	if (!$(this).is('.no-click')) {
    		$('.advent-div').removeClass('active');
        	$(this).toggleClass('active');
    	}
        
    });
});


