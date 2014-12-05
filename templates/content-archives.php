<?php while (have_posts()) : the_post(); ?>
  <div class="page-content">
  	<?php the_content(); ?>
  	<div class="container-fluid">
	  	<div class="row-fluid">
		  	<div class="span6">
				<h2 id="by-month">Efter månad:</h2>
				<ul class="archive-list by-month">
					<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				</ul>
			</div>

			<div class="span6">
				<h2 id="by-category">Efter kategori:</h2>
				<ul class="archive-list by-category">
				<?php wp_list_categories('orderby=id&hierarchical=1&show_count=1&hide_empty=0&title_li='); ?>
				</ul>
			</div>
		</div>
	</div>
	<hr class="fjong-bottom">
  </div>
<? endwhile; 

if(is_page()) {
  echo '</div>'; // close div for page-wrapper
}

?>