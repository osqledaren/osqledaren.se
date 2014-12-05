<? if (false && is_home() && $wp_query->get( 'paged' ) < 2) : ?>
  <div class="archive">
    <div class="page-header" style="display:block;">
      <h1 class="page-title">Osqledaren.se ligger på sparlåga under sommaren, men är tillbaka igen till skolstarten!</h1>
    </div>
  </div>
<?php endif?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>
    <p><?php _e('Sorry, no results were found.', 'roots'); ?></p>
  </div>
  <?php //get_search_form(); ?>
<?php endif; ?>

<?php 
// A counter to know when to place the 'Ads Sidebar'
$post_n = 0; 

while (have_posts()) : the_post(); 

  // Increment the counter
  $post_n++;

  // instantiate Mobile Detect
  $detect = new Mobile_Detect();

  $story_size = get_field('storysize', $post_id);

  // on mobile, all news should be small.
  if ($detect->isMobile() && !$detect->isTablet()){
    $is_mobile = true;
    $story_size = 1;
  }

  $story_size_class = "big-story";
  if($story_size==1){
    $story_size_class = "small-story";
    if(get_field('portrait', $post_id))
      $story_size_class .= " portrait";
  }


  // Get the feed sidabar
  if ( is_home() && $wp_query->get( 'paged' ) < 2 && $post_n == 3 ) {
    dynamic_sidebar( 'Ads Feed' );
  }  
?>
  <article id="post-<?php the_ID(); ?>" <?php post_class($story_size_class); ?>>
    <header class="entry-header">
      <?php roots_entry_date(); ?>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </header>
    <div class="entry-content">
      <div class="entry-thumbnail">
        <a href="<?php echo get_permalink($post->ID)?>">
        <?php 
          if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
            switch ($story_size) {

              //small story 
              case 1: {
                if(get_field('portrait', $post_id))
                  the_post_thumbnail('post-thumbnail-small-portrait');
                else
                  // smartphones other than 320px usually have a bigger width than 320px
                  // and the small thumbnails are usually too small. 
                  // we therefor serve those phones the big size image and let there browsers scale them down.
                  if($is_mobile && !$detect->isiPhone())
                    the_post_thumbnail();
                  else
                    the_post_thumbnail('post-thumbnail-small');
                break;
              }

              default:
                the_post_thumbnail();
            }
          } 
        ?>
        </a>
      </div>
      <?php 
      $categories = get_the_category($post_id);
      $is_vimmel = false;
      if($categories){
        foreach($categories as $category) {
          if($category->cat_name === "Vimmel")
            $is_vimmel = true;
        }
      }

      if($is_vimmel){
        the_content("");
      ?>
      <p>
      <?php } else{ ?>
      <p>
        <?php echo get_the_excerpt(); ?>
        <br/>
      <?php }?>
        <span class="readmore"><a href="<?php echo get_permalink($post->ID)?>">Läs mer</a></span>
      </p>
    </div>
  </article>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav id="post-nav" class="pager">
    <div class="previous"><?php next_posts_link(__('Äldre inlägg', 'roots')); ?></div>
    <div class="next"><?php previous_posts_link(__('Nyare inlägg', 'roots')); ?></div>
  </nav>
<?php endif; ?>
