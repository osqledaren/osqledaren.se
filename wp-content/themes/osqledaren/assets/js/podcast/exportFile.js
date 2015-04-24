var $ = require("jquery");
var React = require("react");

var MainView = require("./_main");


$(document).ready(function(){

	$.getJSON("/wp-content/osqpod-output/podcast.json", function(data){
		if(data){
			window.a = React.render(
				<MainView data={data} />
				, $("#insertContent")[0]);

		}
	})
});


