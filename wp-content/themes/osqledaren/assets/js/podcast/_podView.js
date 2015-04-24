var React = require("react");
var $ = require("jquery");

module.exports = React.createClass({

	componentDidUpdate: function(){
		if(this.props.selected){
			$(this.getDOMNode()).find(".pod_selected").show();
		}else{
			$(this.getDOMNode()).find(".pod_selected").hide();
		}
	},

	handleClick: function(){
		this.props.onClick(this.props.index);
	},


	render: function(){
		return(
			<li className="pod" onClick={this.handleClick}>
				<a className="pod_wrap">
					<div className="pod_art" style={{backgroundImage:"url(" + this.props.data.image + ")"}}>
						<div className="pod_overlay">
							<div className="pod_hover">
							</div>

							<div className="pod_selected" style={{"display":"none"}}>
								<div className="lefter"></div>
								<div className="left"></div>
								<div className="right"></div>
								<div className="righter"></div>
							</div>
						</div>
					</div>
				</a>
			</li>
			);
	}
});