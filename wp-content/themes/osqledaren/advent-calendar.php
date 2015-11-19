<?php
/**
 * Template Name: Advent Calendar
 *
 * @package osqledaren
 */
?>

<?php get_header(); ?>

<div id="adv_cal" class="page_content container">
    <div id="adv_cal_wrapper">
        <?php $array = which_to_show(); ?>
        <?php if($array[1]) :  ?>
           	<div>
                <div class="adv_cal_nr">1</div>
                <iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_1')); ?>" 	width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            </div>
        <?php endif; ?>
        <?php if($array[2]) :  ?>
            <div class="active">
                <div class="adv_cal_nr">2</div>
            	<iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_2')); ?>" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            </div>
        <?php endif; ?>
        <?php if($array[3]) :  ?>
            <div>
                <div class="adv_cal_nr">3</div>
            	<iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_3')); ?>" 	width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            </div>
        <?php endif; ?>
        <?php if($array[4]) :  ?>
            <div>
                <div class="adv_cal_nr">4</div>
           	    <iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_4')); ?>" 	width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            </div>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript" src="/js/compiled/adv_cal.js"></script>

<?php get_footer(); ?>

