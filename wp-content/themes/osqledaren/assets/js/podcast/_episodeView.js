var React = require("react");

module.exports = React.createClass({


	render: function(){
		return(
				<li className="episode">
					<a href={this.props.data.url} target="_blank">
						<div className="ep_wrap">
							<div className="ep_art" style={{"backgroundImage":"url(" + this.props.data.image +")"}}>
								<div className="ep_overlay">
									<div className="ep_hover">
									</div>
								</div>
							</div>
						</div>
				
						<div className="ep_desc">
						<h4>{this.props.data.title}</h4>
						</div>
					</a>
				</li>
			);
	}
});