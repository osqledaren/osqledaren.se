<?php

// Return post entry meta information
function roots_entry_meta() {
  roots_entry_date();
  roots_entry_author();
}

// Return post entry date
function roots_entry_date() {
  echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('%s', 'roots'), get_the_date()) .'</time>';

}

// Return post entry author
function roots_entry_author() {
  echo '<p class="byline author vcard">'. __('Written by', 'roots') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
}
?>