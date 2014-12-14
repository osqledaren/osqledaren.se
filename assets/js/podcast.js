var App = {
	Views:{},
	Models:{},
	Collections:{},
	Router:{}
};

App.Models.PodModel = Backbone.Model.extend({

	initialize:function(data){
		
	}
});

App.Views.SelectedPodView = Backbone.View.extend({

	initialize:function(){
		this.templateID = $("#SelectedPodView");
	},

	tagName:function(){
		return $("#SelectedPodView").data("tag");
	},

	attributes: function(){
		return {
			class:$("#SelectedPodView").data("class")
		}
	},

	template:function(model){
		var source = $("#SelectedPodView").html();
		var temp = Handlebars.compile(source);
		return temp(model);
	},

	render:function(){
		this.$el.html(this.template(this.model.toJSON()));

		height = this.$el.find(".content").height();
		this.$el.find(".pod_bg_wrapper").height(height+75);
		this.$el.find(".pod_bg").height(height+105);

		this.$el.hide();

	},

	show:function(){
		this.$el.fadeIn(1000);
	},

	hide: function(){
		this.$el.hide();
	}

});

App.Views.PodView = Backbone.View.extend({

	initialize:function(){
		this.templateID = $("#PodView");
		this.selectedPodView = new App.Views.SelectedPodView({model:this.model});
		//this.selectedPodView.render();
		this.render();

	},

	tagName:function(){
		return $("#PodView").data("tag");
	},
	attributes: function(){
		return {
			class:$("#PodView").data("class")
		}
	},

	events:{
		"click":"selected"
	},

	selected:function(){
		this.trigger("selected",this);
	},
	showSelected:function(){
		this.$el.find(".pod_selected").toggle();
		this.selectedPodView.show();
	},
	hideSelected:function(){
		this.$el.find(".pod_selected").toggle();
		this.selectedPodView.hide();
	},

	template:function(model){
		var source = this.templateID.html();
		var temp = Handlebars.compile(source);
		return temp(model);
	},

	render:function(){
		this.$el.html(this.template(this.model.toJSON()));

		return this;
	}
});


var AppRouter = Backbone.Router.extend({

	initialize:function(){
		var self = this;
		this.allPods = [];
		var k = 0;
		$.getJSON("podcast/podcast.json",function(data){
			if(data){
				for(var n=0;n < data.length;n+=1){
					self.allPods[n] = new App.Views.PodView({model:new App.Models.PodModel(data[n])});
					$("#insertPods").append(self.allPods[n].el);
					self.allPods[n].$el.hide().fadeIn(2000);

				if ( n !== 0){
					if( (n == (data.length-1)) || ( (n+1) %4 == 0)){
						while( k <= n){
							$("#insertPods").append(self.allPods[k].selectedPodView.el);
							self.allPods[k].selectedPodView.render();
							k = k+1;
						}
					}
				}
			self.allPods[n].on("selected",function(selectedPod){

				if (self.selectedPod){
					self.selectedPod.hideSelected();
				}
				if( self.selectedPod != selectedPod){
					self.selectedPod = selectedPod;
					self.selectedPod.showSelected();
				}else{
					self.selectedPod = false;
				}
			},self)
				}
			}
		})
	}
});

$(document).ready(function(){

	var app = new AppRouter();


});