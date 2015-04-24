var $ = require("jquery");

module.exports = function(){
	
	$(".top").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow",function(){
			$header.removeClass("detached");
			$header.removeClass("headerHidden");
		});
		
	});
}