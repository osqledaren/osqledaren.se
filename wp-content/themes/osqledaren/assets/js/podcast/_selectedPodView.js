var React = require("react");
var $ = require("jquery");

var EpisodeView = require("./_episodeView");


module.exports = React.createClass({

	componentDidUpdate: function(){
		if(this.props.selected){
			var $this = $(this.getDOMNode());
			$this.fadeIn(1000);
			var height = $this.find(".content").height();
			$this.find(".pod_bg_wrapper").height(height+50);
			$this.find(".pod_bg").height(height + 50);
		}else{
			$(this.getDOMNode()).hide();
		}
	},

	render: function(){

		return(
			<li className="episodes padding">
				<div className="pod_bg_wrapper">
					<div className="pod_bg" style={{"backgroundImage":"url(" + this.props.data.blurImage + ")"}}></div>
		
					<div className="content">
						<div className="pod_meta">
							<h2><a href={this.props.data.url}>{this.props.data.title}</a></h2>
							<p>{this.props.data.description}</p>
						</div>
		
						<ul className="episodesList unstyled">
						{this.props.data.item.map(function(item){
							return(
								<EpisodeView data={item} />
								);
						})}
						</ul>
					</div>
				</div>
			</li>
			);
	}
});
