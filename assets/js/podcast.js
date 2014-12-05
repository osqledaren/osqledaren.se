var App = {
	Views:{},
	Models:{},
	Collections:{},
	Router:{}
};

App.Models.PodModel = Backbone.Model.extend({

	initialize:function(data){
		if (data.description){
			this.set("description",data.description.substring(0,70) +"...");
		}
	}
});

App.Collections.PodModelCollection = Backbone.Collection.extend({

	url: function(){
		return "getrss.php?podcast="+this.podName;
	},

	model:App.Models.PodModel,

	initialize:function(data){
		this.podName = data.podName;
		this.fetch({error: function(error) {
			console.log(error);
			}
		});

	},
	parse:function(data){
		console.log(data);

		this.title = new App.Models.PodModel(data);

		return data.item;

	}
});

App.Views.EpisodeView = Backbone.View.extend({

	initialize:function(){
		this.templateID = $("#EpisodeView");
	},

	tagName:function(){
		return $("#EpisodeView").data("tag");
	},

	attributes: function(){
		return {
			class:$("#EpisodeView").data("class")
		}
	},

	template:function(model){
		var source = $("#EpisodeView").html();
		var temp = Handlebars.compile(source);
		return temp(model);
	},

	render:function(){
		this.$el.html(this.template(this.model.toJSON()));
		return this;
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
		this.$el.html(this.template(this.collection.title.toJSON()));

		_.forEach(this.collection.models,function(model){
			this.$el.find("#insertEpisodes").append(new App.Views.EpisodeView({model:model}).render().el)
		},this);

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
		this.selectedPodView = new App.Views.SelectedPodView({collection:this.collection});
		this.collection.on("sync", function(){
			this.render();
			this.selectedPodView.render();
		},this)
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
		/*$('html, body').animate({
			scrollTop: this.selectedPodView.$el.offset().top
		}, 700);
		*/
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
		this.$el.html(this.template(this.collection.title.toJSON()));

		return this;
	}
});

var AppRouter = Backbone.Router.extend({

	initialize:function(){
		this.allPods = [];
		var k = 0;

		for (var i = 0; i < allaPoddar.length; i++){
			this.allPods[i] = new App.Views.PodView({collection:new App.Collections.PodModelCollection({podName:allaPoddar[i]})});
			$("#insertPods").append(this.allPods[i].el);
			this.allPods[i].$el.hide().fadeIn(2000);

			if ( i !== 0){
				if( (i == (allaPoddar.length-1)) || ( (i+1) %4 == 0)){
					while( k <= i){
						$("#insertPods").append(this.allPods[k].selectedPodView.el);
						k = k+1;
					}
				}
			}
			this.allPods[i].on("selected",function(selectedPod){

				if (this.selectedPod){
					this.selectedPod.hideSelected();
				}
				if( this.selectedPod != selectedPod){
					this.selectedPod = selectedPod;
					this.selectedPod.showSelected();
				}else{
					this.selectedPod = false;
				}
			},this)
		}
	}
});

$(document).ready(function(){

	var app = new AppRouter();


});