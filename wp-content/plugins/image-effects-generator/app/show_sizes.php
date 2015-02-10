<?php
  add_filter('image_size_names_choose', 'display_image_sizes_media', 11, 1);
  function display_image_sizes_media( $sizes ) {
    
    $new_sizes = array();
    
    $added_sizes = get_intermediate_image_sizes();
    
    foreach( $added_sizes as $key => $value) {
      $new_sizes[$value] = $value;
    }
    
    $new_sizes = array_merge( $new_sizes, $sizes );
    
    return $new_sizes;
  }
?>