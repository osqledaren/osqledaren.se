<?php
/**
 * Template Name: Advent Calendar
 *
 * @package osqledaren
 */
?>

<?php get_header(); ?>

<div id="adv_calendar" class="page_content container">
    <h2>test</h2>
<?php $array = which_to_show(); ?>
<?php if($array[1]) :  ?>
   	<iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_1')); ?>" 	width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
<?php endif; ?>
<?php if($array[2]) :  ?>
    	<iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_2')); ?>" 	width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
<?php endif; ?>
<?php if($array[3]) :  ?>
    	<iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_3')); ?>" 	width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
<?php endif; ?>
<?php if($array[4]) :  ?>
   	<iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_4')); ?>" 	width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
<?php endif; ?>
</div>

<?php get_footer(); ?>

