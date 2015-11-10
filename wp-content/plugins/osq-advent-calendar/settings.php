<div class="wrap">
	<h2>Osqledaren Advent Calendar Plugin</h2>
	<form method="post" action="options.php"> 
		<?php @settings_fields('osq_advent_calendar-group'); ?>
		<?php @do_settings_fields('osq_advent_calendar-group'); ?>

		<table class="form-table">  
			<tr valign="top">
				<th scope="row"><label for="setting_a">Setting A</label></th>
				<td><input type="text" name="setting_a" id="setting_a" value="<?php echo get_option('setting_a'); ?>" /></td>
			</tr>
		</table>

		<?php @submit_button(); ?>
	</form>
</div>