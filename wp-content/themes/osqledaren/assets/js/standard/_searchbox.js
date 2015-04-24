var $ = require("jquery");

module.exports = function(){
	$('.search_form').click(function() {
		if( !$("search_form").hasClass("selected")){
			$(this).addClass("selected");
			$(".search_field").focus();


		}
	});
}