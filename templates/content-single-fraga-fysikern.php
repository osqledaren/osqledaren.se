<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <header class="entry-header">
      <img src="/assets/img/fraga-fysikern/fraga_fysikern_header.jpg" class="ff-header retinafy">
      <div class="ff-subheader">
        <?php //roots_entry_date(); ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <!-- <img src="/assets/img/fraga-fysikern/fraga_fysikern_header.jpg" class="ff-header-2 retinafy"> -->
      </div>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
      <div style="clear:both;"></div>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      <?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
      <hr class="fjong-bottom">
      <?php social_buttons();?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>