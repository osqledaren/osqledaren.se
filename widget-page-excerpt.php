<?php

function widget_page_excerpt_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_page_excerpt($args, $widget_args = 1) {
		extract( $args, EXTR_SKIP );
		if ( is_numeric($widget_args) )
			$widget_args = array( 'number' => $widget_args );
		$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
		extract( $widget_args, EXTR_SKIP );

		$options = get_option('widget_page_excerpt');
		if ( !isset($options[$number]) )
			return;
		extract($options[$number]);

		apply_filters('widget_title', $title);

		$query = new WP_Query(array(
			'pagename' => $page,
			'post_status' => 'publish',
		));

		if (!$query->have_posts()): /* No page to show */
			return;

		else: /* Page to show exists */

		// Output a widget box with the page excerpt
		while ($query->have_posts()): $query->the_post();
		global $more; $more = 0;
		$content = get_the_content();

		// Show the widget even if the page has an empty excerpt?
		if (strlen($content) < 1)
			return;
		
		// Use the page title of no widget title is specified
		if (strlen($title) < 1)
			$title = get_the_title();

		// echo $before_widget . $before_title . $title . $after_title;
		echo $before_widget;
		the_content('');
		echo $after_widget;

		endwhile; // Output a widget box with the page excerpt

		endif; /* Page to show exists */

		// Restore global post data stomped by the_post().
		wp_reset_query();

	}

	function widget_page_excerpt_control($widget_args) {
		global $wp_registered_widgets;
		static $updated = false;

		if ( is_numeric($widget_args) )
			$widget_args = array( 'number' => $widget_args );
		$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
		extract( $widget_args, EXTR_SKIP );

		$options = get_option('widget_page_excerpt');
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
				if ( 'wp_widget_page_excerpt' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
					$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
					if ( !in_array( "page-excerpt-$widget_number", $_POST['widget-id'] ) ) // the widget has been removed.
						unset($options[$widget_number]);
				}
			}

			foreach ( (array) $_POST['widget-page-excerpt'] as $widget_number => $widget_page_excerpt ) {
				if ( !isset($widget_page_excerpt['page']) && isset($options[$widget_number]) ) // user clicked cancel
					continue;
				$title = strip_tags(stripslashes($widget_page_excerpt['title']));
				$page = strip_tags(stripslashes($widget_page_excerpt['page']));
				$options[$widget_number] = compact('title', 'page');
			}

			update_option('widget_page_excerpt', $options);
			$updated = true;
		}

		if ( -1 == $number ) {
			$title = '';
			$page = '';
			$number = '%i%';
		} else {
			$title = attribute_escape($options[$number]['title']);
			$page = attribute_escape($options[$number]['page']);
		}
?>
		<p><label for="page-excerpt-title-<?php echo $number; ?>">Titel: <input class="widefat" id="page-excerpt-title-<?php echo $number; ?>" name="widget-page-excerpt[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="page-excerpt-page-<?php echo $number; ?>">Sida (permalänknamn): <input class="widefat" id="page-excerpt-page-<?php echo $number; ?>" name="widget-page-excerpt[<?php echo $number; ?>][page]" type="text" value="<?php echo $page; ?>" /></label></p>
		<input type="hidden" name="widget-page-excerpt[<?php echo $number; ?>][submit]" value="1" />
<?php
	}
	
	### Register page excerpt widgets
	function widget_page_excerpt_register() {

		if ( !$options = get_option('widget_page_excerpt') )
			$options = array();
		$widget_ops = array('classname' => 'widget_page_excerpt', 'description' => __('Shows the excerpt of a page'));
		$control_ops = array('width' => 300, 'height' => 20, 'id_base' => 'page-excerpt');
		$name = __('Page excerpt');

		$id = false;
		foreach ( (array) array_keys($options) as $o ) {
			$id = "page-excerpt-$o"; // Never never never translate an id
			wp_register_sidebar_widget($id, $name, 'widget_page_excerpt', $widget_ops, array( 'number' => $o ));
			wp_register_widget_control($id, $name, 'widget_page_excerpt_control', $control_ops, array( 'number' => $o ));
		}

		// If there are none, we register the widget's existance with a generic template
		if ( !$id ) {
			wp_register_sidebar_widget( 'page-excerpt-1', $name, 'widget_page_excerpt', $widget_ops, array( 'number' => -1 ) );
			wp_register_widget_control( 'page-excerpt-1', $name, 'widget_page_excerpt_control', $control_ops, array( 'number' => -1 ) );
		}

	}

	widget_page_excerpt_register();

}

add_action('widgets_init', 'widget_page_excerpt_init');
