<?php while (have_posts()) : the_post(); ?>
  <div class="page-content">
  	<?php the_content(); ?>
  	<hr class="fjong-bottom">
  </div>
  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; 

if(is_page()) {
  echo '</div>'; // close div for page-wrapper
}

?>