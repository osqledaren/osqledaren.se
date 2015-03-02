<?php
/**
 * Template Name: Podcast
 *
 * @package osqledaren
 */
?>

<?php get_header(); ?>

<div id="pods" class="page_content container">
	<div class="row clearfix">
		<ul id="insertPods">
			<!-- Here comes the pods, dudududu -->
		</ul>
	</div>
</div>

<!--#PodView PODDARNAS STORA RUTA -->
<script data-class="pod" data-tag="li" id="PodView" type="text/x-handlebars-template">
	<a class="pod_wrap">
		<div class="pod_art" style="background-image:url({{image}})">
			<div class="pod_overlay">
				<div class="pod_hover"></div>

				<div class="pod_selected" style="display:none">
					<div class="lefter"></div>
					<div class="left"></div>
					<div class="right"></div>
					<div class="righter"></div>
				</div>
			</div>
		</div>
	</a><!-- /.pod_wrap -->
</script>

<!--#SelectedPodView DROPDOWN-RUTAN OM VALD PODD -->
<script data-class="episodes padding" data-tag="li" id="SelectedPodView" type="text/x-handlebars-template">	
	<div class="pod_bg_wrapper">
		<div class="pod_bg" style="background-image:url({{blurImage}})"></div>
	</div>

	<div class="content">
		<div class="pod_meta">
			<h2><a href="{{url}}">{{title}}<a/></h2>
			<p>{{description}}</p>
		</div>
	
		<ul class="episodesList" id="insertEpisodes">
			{{#each item}} 
				<li class="episode">
					<a href="{{url}}" target="_blank">
						<div class="ep_wrap">
							<div class="ep_art" style="background-image:url({{image}})">
								<div class="ep_overlay">
									<div class="ep_hover">

									</div>
								</div>
							</div>
						</div><!-- /.ep_wrap -->
			
						<div class="ep_desc">
							<h3>{{title}}</h3>
						</div>
					</a>
				</li><!-- /.episode -->

			{{/each}}
		</ul>
	</div><!-- /.content -->
</script>

<!--#EpisodeView  EPISODERNA I DEN VALDA PODDENS VY -->
<script data-tag="li" data-class="episode" id="EpisodeView" type="text/x-handlebars-template">
	<a href="{{url}}" target="_blank">
		<div class="ep_wrap">
			<div class="ep_art" style="background-image:url({{image}})">
				<div class="ep_overlay">
					<div class="ep_hover">

					</div>
				</div>
			</div>
		</div><!-- /.ep_wrap -->
		
		<div class="ep_desc">
			<h3>{{title}}</h3>
		</div>
	</a>
</script>

<?php get_footer(); ?>
