<?php

  $my_options = get_option('sharpened');
  if ( $my_options === yes_please ) {

    add_image_size( 'image-effects-1000-sharpened', 1000, 1000, false );
    add_image_size( 'image-effects-800-sharpened', 800, 800, false );
    add_image_size( 'image-effects-400-sharpened', 400, 400, false );

    add_filter('wp_generate_attachment_metadata','image_effects_sharpened_filter');
    function image_effects_sharpened_filter($meta) {
      $file = $meta['sizes']['image-effects-1000-sharpened']['file'];
      $meta['sizes']['image-effects-1000-sharpened']['file'] = do_sharpened_filter($file);
      $file = $meta['sizes']['image-effects-800-sharpened']['file'];
      $meta['sizes']['image-effects-800-sharpened']['file'] = do_sharpened_filter($file);
      $file = $meta['sizes']['image-effects-400-sharpened']['file'];
      $meta['sizes']['image-effects-400-sharpened']['file'] = do_sharpened_filter($file);
      return $meta;
    }

    function do_sharpened_filter($file) {
      $dir = wp_upload_dir();
      $image = wp_load_image(trailingslashit($dir['path']).$file);
      $sharpen = array(
        array(-1.2, -1, -1.2), 
        array(-1, 20, -1), 
        array(-1.2, -1, -1.2)
      );
      $divisor = array_sum(array_map('array_sum', $sharpen));
      imageconvolution($image, $sharpen, $divisor, 0);
      return save_modified_image_sharpened($image, $file, '-sharpened');
    }

    function save_modified_image_sharpened($image, $filename, $suffix) {
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