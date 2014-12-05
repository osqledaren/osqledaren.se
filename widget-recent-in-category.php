<?php

/** Updates for Wordpress 3.1 by Petter Eek **/

function widget_recent_in_category_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_recent_in_category($args, $widget_args = 1) {
		extract( $args, EXTR_SKIP );
		if ( is_numeric($widget_args) )
			$widget_args = array( 'number' => $widget_args );
		$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
		extract( $widget_args, EXTR_SKIP );

		$options = get_option('widget_recent_in_category');
		if ( !isset($options[$number]) )
			return;
		extract($options[$number]);

		apply_filters('widget_title', $title);

		if ( !$count = (int) $count )
			$count = 5;
		else if ($count < 1)
			$count = 1;
		else if ($count > 10)
			$count = 10;
		
		$args = array(
			'numberposts'	=> $count,
			'category_name' => $category,
			'post_status'	=> 'publish'
			);
		$postslist = get_posts($args);
		
		echo $before_widget . $before_title . $title . $after_title;

		global $post;
		global $more;

		foreach ($postslist as $post) :
			setup_postdata($post);
			$more = 0;
	?>
			<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent länk till <?php the_title(); ?>"><?php the_title(); ?></a></h5>
			<?php the_content(''); ?>
	<?php
		endforeach;
		echo $after_widget;
	}

	function widget_recent_in_category_control($widget_args) {
		global $wp_registered_widgets;
		static $updated = false;

		if ( is_numeric($widget_args) )
			$widget_args = array( 'number' => $widget_args );
		$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
		extract( $widget_args, EXTR_SKIP );

		$options = get_option('widget_recent_in_category');
		if ( !is_array($options) )
			$options = array();

		if ( !$updated && !empty($_POST['sidebar']) ) {
			$sidebar = (string) $_POST['sidebar'];

			$sidebars_widgets = wp_get_sidebars_widgets();
			if ( isset($sidebars_widgets[$sidebar]) )
				$this_sidebar =& $sidebars_widgets[$sidebar];
			else
				$this_sidebar = array();

			foreach ( (array) $this_sidebar as $_widget_id ) {
				if ( 'wp_widget_recent_in_category' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
					$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
					if ( !in_array( "recent-in-category-$widget_number", $_POST['widget-id'] ) ) // the widget has been removed.
						unset($options[$widget_number]);
				}
			}

			foreach ( (array) $_POST['widget-recent-in-category'] as $widget_number => $widget_recent_in_category ) {
				if ( !isset($widget_recent_in_category['category']) && isset($options[$widget_number]) ) // user clicked cancel
					continue;
				$title = strip_tags(stripslashes($widget_recent_in_category['title']));
				$category = strip_tags(stripslashes($widget_recent_in_category['category']));
				$count = (int) $widget_recent_in_category['count'];
				$options[$widget_number] = compact('title', 'category', 'count');
			}

			update_option('widget_recent_in_category', $options);
			$updated = true;
		}

		if ( -1 == $number ) {
			$title = '';
			$category = '';
			$count = '5';
			$number = '%i%';
		} else {
			$title = attribute_escape($options[$number]['title']);
			$category = attribute_escape($options[$number]['category']);
			$count = attribute_escape($options[$number]['count']);
		}
?>
		<p><label for="recent-in-category-title-<?php echo $number; ?>">Titel: <input class="widefat" id="recent-in-category-title-<?php echo $number; ?>" name="widget-recent-in-category[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="recent-in-category-category-<?php echo $number; ?>">Kategori: <input class="widefat" id="recent-in-category-category-<?php echo $number; ?>" name="widget-recent-in-category[<?php echo $number; ?>][category]" type="text" value="<?php echo $category; ?>" /></label></p>
		<p><label for="recent-in-category-count-<?php echo $number; ?>">Antal utdrag att visa: <input style="width: 25px; text-align: center;" id="recent-in-category-count-<?php echo $number; ?>" name="widget-recent-in-category[<?php echo $number; ?>][count]" type="text" value="<?php echo $count; ?>" /></label> <small>(max 10)</small></p>
		<input type="hidden" name="widget-recent-in-category[<?php echo $number; ?>][submit]" value="1" />
<?php
	}
	
	### Register page excerpt widgets
	function widget_recent_in_category_register() {

		if ( !$options = get_option('widget_recent_in_category') )
			$options = array();
		$widget_ops = array('classname' => 'widget_recent_in_category', 'description' => __('Shows excerpts of the latest posts in a category'));
		$control_ops = array('width' => 300, 'height' => 20, 'id_base' => 'recent-in-category');
		$name = __('Recent in category');

		$id = false;
		foreach ( (array) array_keys($options) as $o ) {
			$id = "recent-in-category-$o"; // Never never never translate an id
			wp_register_sidebar_widget($id, $name, 'widget_recent_in_category', $widget_ops, array( 'number' => $o ));
			wp_register_widget_control($id, $name, 'widget_recent_in_category_control', $control_ops, array( 'number' => $o ));
		}

		// If there are none, we register the widget's existance with a generic template
		if ( !$id ) {
			wp_register_sidebar_widget( 'recent-in-category-1', $name, 'widget_recent_in_category', $widget_ops, array( 'number' => -1 ) );
			wp_register_widget_control( 'recent-in-category-1', $name, 'widget_recent_in_category_control', $control_ops, array( 'number' => -1 ) );
		}

	}

	widget_recent_in_category_register();

}

add_action('widgets_init', 'widget_recent_in_category_init');
