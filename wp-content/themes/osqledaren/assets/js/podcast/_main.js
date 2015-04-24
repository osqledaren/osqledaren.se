var $ = require("jquery");
var React = require("react");

var PodView = require("./_podView");
var SelectedPodView = require("./_selectedPodView");

module.exports = React.createClass({

	podsPerRowCalc: function(){
		var siteWidth = $("body").width();

		if(siteWidth > 1180){
			return 4
		}else if(siteWidth > 767){
			return 3
		}else if(siteWidth > 510){
			return 2
		}else{
			return 1
		}
	},

	componentDidMount: function(){
		var _this = this;
		$(window).on("resize", function(){
			_this.setState({
				podsPerRow: _this.podsPerRowCalc()
			});
		})
	},

	getInitialState: function(){

		return {
			podsPerRow: this.podsPerRowCalc(),
			selectedPod: -1
		};
	},

	selectedAPod: function(i){
		if(this.state.selectedPod == i){
			this.setState({selectedPod: -1})
		}else{
			this.setState({selectedPod: i});
		}
	},

	render: function(){
		var _this = this;
		var PPR = this.state.podsPerRow

		//All the podViews.
		var podList = this.props.data.map(function(pod, i){
			//Has this pod been selected?
			var selected = _this.state.selectedPod == i ? true : false;
			return <PodView onClick={_this.selectedAPod} index={i} data={pod} selected={selected} />
		})

		//All the SelectedPodViews.
		var selectedPodList = this.props.data.map(function(pod, i){
			//Has this pod been selected?
			var selected = _this.state.selectedPod == i ? true : false;
			return <SelectedPodView data={pod} selected={selected} />
		})

		insertList = [];
		for(var i = 0; i < podList.length; i++){
			//Add a podview.
			insertList.push(podList[i]);

			//Every time i has incremented by this.state.podsPerRow..
			//..all selectedPodView are to be appended.
			if((i+1) % PPR == 0){

				//From latest checkpoint to i.
				for(var n = i + 1 - PPR; n <= i; n++){

					insertList.push(selectedPodList[n]);
				}

			//If it reached end of postList there are some SelectedPodView left
			//Since the last checkpoint
			//Append all the missing selectedPodView.
			}else if(i == podList.length -1){
				for(var n = i - (i%PPR); n < podList.length; n++){
					insertList.push(selectedPodList[n]);
				}
			}

		}

		return(
			<ul className="unstyled">
				{insertList}
			</ul>);
	}
});