<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package osqledaren
 */

/**
 * Assistive functions.
 */
if ( !function_exists( 'ends_with' ) ) :
	function ends_with($string, $test) {
		$strlen = strlen($string);
		$testlen = strlen($test);
		if ($testlen > $strlen) return false;
		return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
	}
endif;
if ( !function_exists( 'is_blurred_image' ) ) :
	function is_blurred_image($img) {
		$name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $img);
		if ( ends_with($name, '-blurred' ) ) {
			return true;
		} else {
			return false;
		}
	}
endif;


if ( !function_exists( 'osqledaren_paginator' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function osqledaren_paginator() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	
	if ( get_next_posts_link() && !get_previous_posts_link()) {
		$class = ' no_prev';
	} elseif ( get_previous_posts_link() && !get_next_posts_link() ) {
		$class = ' no_next';
	} else {
		$class = '';
	}
	?>
	<div id="paginator" class="clearfix<?php echo $class; ?>">
		<?php if ( get_previous_posts_link() ) : ?>
		<a class="prev" href="<?php echo get_previous_posts_page_link(''); ?>">Föregående sida</a>
		<?php endif; ?>
		
		<?php if ( get_next_posts_link() ) : ?>
		<a class="next" href="<?php echo get_next_posts_page_link(''); ?>">Nästa sida</a>
		<?php endif; ?>
	</div>
	<?php
}
endif;


if ( !function_exists( 'osqledaren_thumbnail' ) ) :
/**
 * Display post thumbnail
 */

function osqledaren_thumbnail($size='full', $post_id=NULL) {
	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id($post_id);
		
		if ( $size == 'blurred' ) {

			$size = 'large-blurred-effect';
			$thumb = wp_get_attachment_image_src($thumb_id, $size)[0];
			
			if ( !is_blurred_image($thumb) ) {
				$size = 'medium-blurred-effect';
				$thumb = wp_get_attachment_image_src($thumb_id, $size)[0];
				
				if ( !is_blurred_image($thumb) ) {
					$size = 'small-blurred-effect';
					$thumb = wp_get_attachment_image_src($thumb_id, $size)[0];
				
					if ( !is_blurred_image($thumb) ) {
						$size = 'tiny-blurred-effect';
						$thumb = wp_get_attachment_image_src($thumb_id, $size)[0];
					}
				}
			}
		} else {
			$thumb = wp_get_attachment_image_src($thumb_id, $size)[0];
		}
		
		echo $thumb;
	}
}
endif;


if ( !function_exists( 'osqledaren_cred') ) :
/**
 * Credits for current post.
 */
function osqledaren_cred() {
	$output = '';

	$field_data = get_field('cred');
	write_log($field_data);
	if ( !$field_data == '' ) {
		$field_rows = explode("\n", $field_data); //Needs to be double-quoted, not recognized as newline by PHP otherwise.
		write_log($field_rows);

		foreach ( $field_rows as $field_row) {
			$field_row = explode('=', $field_row);
			$creators = explode(',', $field_row[1]);
			
			$output .= $field_row[0] . '<span class="slash">//</span>';

			$comma_index = 0; //If more than one contributor in that field, add a comma.
			foreach ( $creators as $creator ) {
				if ($comma_index > 0 ){
					$output .= ", ";
				}
				$comma_index +=1;
				$output .= $creator;
			}

			$output .= '</br>';
		}
		
		echo $output;
	} else {
		echo '';
	}
}
endif;


if ( !function_exists( 'osqledaren_posted_on' ) ) :
/**
 * Prints HTML with date for current post.
  */
function osqledaren_posted_on() {
	if ( date('Y') == get_the_date('Y') ) {
		echo get_the_date('j F');
	} else {
		echo get_the_date('j F Y');
	}
}
endif;


if ( !function_exists( 'osqledaren_categories' ) ) :
/**
 * Prints HTML with categories for current post.
 */
function osqledaren_categories() {
	$categories = get_the_category();
	$count = 1;
	$total = count($categories);
	
	$output = '<span class="cat">';
	foreach ( $categories as $category ) {
		$output .= '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a>';
		if ($count < $total) {
			$output .= ', ';
		}
		$count ++;
	}
	$output .= '</span>';
	echo $output;
}
endif;


if ( !function_exists( 'osqledaren_next_post' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function osqledaren_next_post() {
	$next_post = get_previous_post();
	
	if ( !empty( $next_post ) ):
		if ( has_post_thumbnail( $next_post->ID ) ) {
			//$thumb_id = get_post_thumbnail_id($next_post->ID);
			//$thumb = wp_get_attachment_image_src($thumb_id, 'large')[0];

			$thumb_id = get_post_thumbnail_id($next_post->ID);
			
			$size = 'large-blurred-effect';
			$thumb = wp_get_attachment_image_src($thumb_id, $size)[0];
			
			if ( !is_blurred_image($thumb) ) {
				$size = 'medium-blurred-effect';
				$thumb = wp_get_attachment_image_src($thumb_id, $size)[0];
				
				if ( !is_blurred_image($thumb) ) {
					$size = 'small-blurred-effect';
					$thumb = wp_get_attachment_image_src($thumb_id, $size)[0];
				
					if ( !is_blurred_image($thumb) ) {
						$size = 'tiny-blurred-effect';
						$thumb = wp_get_attachment_image_src($thumb_id, $size)[0];
					}
				}
			}
			$background = ' style="background-image:url('.$thumb.')"';
		} else {
			$background = '';
		}
	
	preg_match('/^([^.!?]*[\.!?]+){0,4}/', strip_shortcodes(strip_tags($next_post->post_content)), $abstract);
	if ( $abstract[0] != '' ) {
		$abstract = $abstract[0];
	} else {
		$abstract = $next_post->post_excerpt;
	}
	?>
	<?php write_log($next_post->guid); ?>

	<a href="/?<?php echo parse_url($next_post->guid)["query"]; ?>"><div class="next"<?php echo $background; ?> >
		<div class="overlay">
			<div class="row">
				<div class="padding">
					<div class="meta clearfix">
						<p class="desc">Nästa artikel:</p>
						<div class="time"><?php post_read_time($next_post->ID); ?></div>
					</div>
					<hr>
					<div class="content">
						<h2 class="title"><?php echo $next_post->post_title; ?></h2>
						<p class="excerpt"><?php echo $abstract; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div></a><!-- /.next -->
	
	<?php endif;
}
endif;


if ( !function_exists( 'osqledaren_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function osqledaren_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'osqledaren' ) );
		if ( $categories_list && osqledaren_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'osqledaren' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'osqledaren' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'osqledaren' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'osqledaren' ), __( '1 Comment', 'osqledaren' ), __( '% Comments', 'osqledaren' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'osqledaren' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( !function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'osqledaren' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'osqledaren' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'osqledaren' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'osqledaren' ), get_the_date( _x( 'Y', 'yearly archives date format', 'osqledaren' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'osqledaren' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'osqledaren' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'osqledaren' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'osqledaren' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'osqledaren' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'osqledaren' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'osqledaren' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'osqledaren' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'osqledaren' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'osqledaren' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'osqledaren' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'osqledaren' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'osqledaren' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'osqledaren' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'osqledaren' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'osqledaren' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( !function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function osqledaren_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'osqledaren_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'osqledaren_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so osqledaren_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so osqledaren_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in osqledaren_categorized_blog.
 */
function osqledaren_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'osqledaren_categories' );
}
add_action( 'edit_category', 'osqledaren_category_transient_flusher' );
add_action( 'save_post',     'osqledaren_category_transient_flusher' );
