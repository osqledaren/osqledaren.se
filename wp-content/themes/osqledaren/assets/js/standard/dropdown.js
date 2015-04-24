var $ = require("jquery");

module.exports = function(){
		//COLLAPSE-SCRIPT
	$(".collapse-icon").click(function() {
		if ( !$(".dropdown-menu").is(":visible") ) {
			$(".dropdown-menu").slideDown();
		} else {
			$(".dropdown-menu").slideUp();
		}
	});
}