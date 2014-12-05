<?php

/** Random Fråga Fysikern post By Nadan Gergeo
Made using Petter Eek's category widget **/

function fraga_fysikern_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function fraga_fysikern($args, $widget_args = 1) {
		extract( $args, EXTR_SKIP );
		if ( is_numeric($widget_args) )
			$widget_args = array( 'number' => $widget_args );
		$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
		extract( $widget_args, EXTR_SKIP );

		$options = get_option('fraga_fysikern');
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
			'post_status'	=> 'publish',
			'orderby'       => 'rand'
			);
		$postslist = get_posts($args);
		
		echo $before_widget . $before_title . '<a href="/kategorier/fraga-fysikern/" title="Fråga fysikern">' . $title . '</a>' . $after_title;

		global $post;
		global $more;

		foreach ($postslist as $post) :
			setup_postdata($post);
			$more = 0;
	?>
			<h4 class="fraga-fysikern-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent länk till <?php the_title(); ?>"><?php the_title(); ?></a></h4>
			<?php if(isset($image)) {?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent länk till <?php the_title(); ?>"><img src="<?php echo $image;?>" class="fysikern retinafy" alt="Göran Manneberg"/></a>
			<?php }?>
			<p>
		    	<?php echo get_the_excerpt(); ?>
		    	<br/>
		    	<span class="readmore"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent länk till <?php the_title(); ?>">Läs svaret</a></span>
		    </p>
	<?php
		endforeach;
		echo $after_widget;
	}

	function fraga_fysikern_control($widget_args) {
		global $wp_registered_widgets;
		static $updated = false;

		if ( is_numeric($widget_args) )
			$widget_args = array( 'number' => $widget_args );
		$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
		extract( $widget_args, EXTR_SKIP );

		$options = get_option('fraga_fysikern');
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
				if ( 'wp_fraga_fysikern' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
					$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
					if ( !in_array( "fraga-fysikern-$widget_number", $_POST['widget-id'] ) ) // the widget has been removed.
						unset($options[$widget_number]);
				}
			}

			foreach ( (array) $_POST['widget-fraga-fysikern'] as $widget_number => $fraga_fysikern ) {
				if ( !isset($fraga_fysikern['category']) && isset($options[$widget_number]) ) // user clicked cancel
					continue;
				$title = strip_tags(stripslashes($fraga_fysikern['title']));
				$category = strip_tags(stripslashes($fraga_fysikern['category']));
				$image = strip_tags($fraga_fysikern['image']);
				$count = (int) $fraga_fysikern['count'];
				$options[$widget_number] = compact('title', 'category', 'count', 'image');
			}

			update_option('fraga_fysikern', $options);
			$updated = true;
		}

		if ( -1 == $number ) {
			$title = '';
			$category = '';
			$image = '';
			$count = '5';
			$number = '%i%';
		} else {
			$title = attribute_escape($options[$number]['title']);
			$category = attribute_escape($options[$number]['category']);
			$image = attribute_escape($options[$number]['image']);
			$count = attribute_escape($options[$number]['count']);
		}
?>
		<p><label for="fraga-fysikern-title-<?php echo $number; ?>">Titel: <input class="widefat" id="fraga-fysikern-title-<?php echo $number; ?>" name="widget-fraga-fysikern[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="fraga-fysikern-category-<?php echo $number; ?>">Kategori: <input class="widefat" id="fraga-fysikern-category-<?php echo $number; ?>" name="widget-fraga-fysikern[<?php echo $number; ?>][category]" type="text" value="<?php echo $category; ?>" /></label></p>
		<p><label for="fraga-fysikern-count-<?php echo $number; ?>">Antal utdrag att visa: <input style="width: 25px; text-align: center;" id="fraga-fysikern-count-<?php echo $number; ?>" name="widget-fraga-fysikern[<?php echo $number; ?>][count]" type="text" value="<?php echo $count; ?>" /></label> <small>(max 10)</small></p>
		<p><label for="fraga-fysikern-image-<?php echo $number; ?>">URL till bild på fysikern: <input class="widefat" id="fraga-fysikern-image-<?php echo $number; ?>" name="widget-fraga-fysikern[<?php echo $number; ?>][image]" type="text" value="<?php echo $image; ?>" /></label></p>
		<input type="hidden" name="widget-fraga-fysikern[<?php echo $number; ?>][submit]" value="1" />
<?php
	}
	
	### Register page excerpt widgets
	function fraga_fysikern_register() {

		if ( !$options = get_option('fraga_fysikern') )
			$options = array();
		$widget_ops = array('classname' => 'fraga_fysikern', 'description' => __('Hämtar en slumpmässig fråga fysikern fråga.'));
		$control_ops = array('width' => 300, 'height' => 20, 'id_base' => 'fraga-fysikern');
		$name = __('Fråga fysikern');

		$id = false;
		foreach ( (array) array_keys($options) as $o ) {
			$id = "fraga-fysikern-$o"; // Never never never translate an id
			wp_register_sidebar_widget($id, $name, 'fraga_fysikern', $widget_ops, array( 'number' => $o ));
			wp_register_widget_control($id, $name, 'fraga_fysikern_control', $control_ops, array( 'number' => $o ));
		}

		// If there are none, we register the widget's existance with a generic template
		if ( !$id ) {
			wp_register_sidebar_widget( 'fraga-fysikern-1', $name, 'fraga_fysikern', $widget_ops, array( 'number' => -1 ) );
			wp_register_widget_control( 'fraga-fysikern-1', $name, 'fraga_fysikern_control', $control_ops, array( 'number' => -1 ) );
		}

	}

	fraga_fysikern_register();

}

add_action('widgets_init', 'fraga_fysikern_init');
