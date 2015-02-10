<?php

  $my_options = get_option('negative');
  if ( $my_options === yes_please ) {

    add_image_size( 'image-effects-1000-negative', 1000, 1000, false );
    add_image_size( 'image-effects-800-negative', 800, 800, false );
    add_image_size( 'image-effects-400-negative', 400, 400, false );

    add_filter('wp_generate_attachment_metadata','image_effects_negative_filter');
    function image_effects_negative_filter($meta) {
      $file = $meta['sizes']['image-effects-1000-negative']['file'];
      $meta['sizes']['image-effects-1000-negative']['file'] = do_negative_filter($file);
      $file = $meta['sizes']['image-effects-800-negative']['file'];
      $meta['sizes']['image-effects-800-negative']['file'] = do_negative_filter($file);
      $file = $meta['sizes']['image-effects-400-negative']['file'];
      $meta['sizes']['image-effects-400-negative']['file'] = do_negative_filter($file);
      return $meta;
    }

    function do_negative_filter($file) {
      $dir = wp_upload_dir();
      $image = wp_load_image(trailingslashit($dir['path']).$file);
      imagefilter($image, IMG_FILTER_NEGATE);
      return save_modified_image_negative($image, $file, '-negative');
    }

    function save_modified_image_negative($image, $filename, $suffix) {
      $dir = wp_upload_dir();
      $dest = trailingslashit($dir['path']).$filename;

      list($orig_w, $orig_h, $orig_type) = @getimagesize($dest);

      $filename = str_ireplace(array('.jpg', '.jpeg', '.gif', '.png'), array($suffix.'.jpg', $suffix.'.jpeg', $suffix.'.gif', $suffix.'.png'), $filename);
      $dest = trailingslashit($dir['path']).$filename;

      switch ($orig_type) {
          case IMAGETYPE_GIF:
              imagegif( $image, $dest );
              break;
          case IMAGETYPE_PNG:
              imagepng( $image, $dest );
              break;
          case IMAGETYPE_JPEG:
              imagejpeg( $image, $dest );
              break;
      }

      return $filename;
    }

  }

?>