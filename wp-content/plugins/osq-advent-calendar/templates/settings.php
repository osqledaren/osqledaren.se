<div class="wrap">
	<h2>Osqledaren Advent Calendar Plugin</h2>
	<form method="post" action="options.php">
		<?php @settings_fields('osq_advent_calendar-group'); ?>
		<?php @do_settings_fields('osq_advent_calendar-group'); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="osq_cal_adv_1">Första advent</label></th>
				<td><input type="text" name="osq_cal_adv_1" id="osq_cal_adv_1" value="<?php echo get_option('osq_cal_adv_1'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="osq_cal_adv_2">Andra advent</label></th>
				<td><input type="text" name="osq_cal_adv_2" id="osq_cal_adv_2" value="<?php echo get_option('osq_cal_adv_2'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="osq_cal_adv_3">Tredje advent</label></th>
				<td><input type="text" name="osq_cal_adv_3" id="osq_cal_adv_3" value="<?php echo get_option('osq_cal_adv_3'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="osq_cal_adv_4">Fjärde advent</label></th>
				<td><input type="text" name="osq_cal_adv_4" id="osq_cal_adv_4" value="<?php echo get_option('osq_cal_adv_4'); ?>" /></td>
			</tr>
		</table>

		<?php @submit_button(); ?>
	</form>
</div>
