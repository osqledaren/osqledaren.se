<?php
/**
 * Template Name: Advent Calendar
 *
 * @package osqledaren
 */
?>

<?php get_header(); ?>

<div id="adv_cal" class="page_content container">
    <?php $array = which_to_show(); ?>
    <?php if($array[1] === 0) : ?>
        <div id="adv_cal_wrapper" class="no-click">
    <?php else : ?>
        <div id="adv_cal_wrapper">
    <?php endif; ?>
        <div>
            <div class="adv_cal_nr">1</div>
            <?php if($array[1]) :  ?>
                <iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_1')); ?>"  frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            <?php endif; ?>
        </div>
        <div class="active">
            <div class="adv_cal_nr">2</div>
            <?php if($array[2]) :  ?>
               <iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_2')); ?>" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            <?php endif; ?>
        </div>
        <div>
            <div class="adv_cal_nr">3</div>
            <?php if($array[3]) :  ?>
               <iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_3')); ?>" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            <?php endif; ?>
        </div>
        <div>
            <div class="adv_cal_nr">4</div>
            <?php if($array[4]) :  ?>
                <iframe src="<?php echo str_replace('watch?v=', 'v/', get_option('osq_cal_adv_4')); ?>" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

