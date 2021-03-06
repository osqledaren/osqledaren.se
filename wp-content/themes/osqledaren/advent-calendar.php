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
    <div id="adv_cal_wrapper">
    <?php if($array[1] === 0) : ?>
        <div class="advent-div no-click">
            <div class="adv_cal_nr">1<small>advent</small><div class="lock"><img src="<?php bloginfo('template_url') ?>/assets/img/lock.png"/></div></div>
    <?php else : ?>
        <div class="advent-div active">
            <div class="adv_cal_nr">1<small>advent</small><div class="lock"><div class="thumbnail-wrapper"><img src="http://img.youtube.com/vi/<?php echo get_option('osq_cal_adv_1') ?>/sddefault.jpg"/></div></div></div>
    <?php endif; ?>
            <?php if($array[1]) :  ?>
                <iframe src="https://www.youtube.com/embed/<?php echo get_option('osq_cal_adv_1'); ?>" frameborder="0" allowfullscreen></iframe>
            <?php endif; ?>
        </div>
    <?php if($array[2] === 0) : ?>
        <div class="advent-div no-click">
            <div class="adv_cal_nr">2<small>advent</small><div class="lock"><img src="<?php bloginfo('template_url') ?>/assets/img/lock.png"/></div></div>
    <?php else : ?>
        <div class="advent-div active">
            <div class="adv_cal_nr">2<small>advent</small><div class="lock"><div class="thumbnail-wrapper"><img src="http://img.youtube.com/vi/<?php echo get_option('osq_cal_adv_2') ?>/sddefault.jpg"/></div></div></div>
    <?php endif; ?>
            <?php if($array[2]) :  ?>
                <iframe src="https://www.youtube.com/embed/<?php echo get_option('osq_cal_adv_2'); ?>" frameborder="0" allowfullscreen></iframe>
            <?php endif; ?>
        </div>
    <?php if($array[3] === 0) : ?>
        <div class="advent-div no-click">
            <div class="adv_cal_nr">3<small>advent</small><div class="lock"><img src="<?php bloginfo('template_url') ?>/assets/img/lock.png"/></div></div>
    <?php else : ?>
        <div class="advent-div active">
            <div class="adv_cal_nr">3<small>advent</small><div class="lock"><div class="thumbnail-wrapper"><img src="http://img.youtube.com/vi/<?php echo get_option('osq_cal_adv_3') ?>/sddefault.jpg"/></div></div></div>
    <?php endif; ?>
            <?php if($array[3]) :  ?>
                <iframe src="https://www.youtube.com/embed/<?php echo get_option('osq_cal_adv_3'); ?>" frameborder="0" allowfullscreen></iframe>
            <?php endif; ?>
        </div>
    <?php if($array[4] === 0) : ?>
        <div class="advent-div no-click">
            <div class="adv_cal_nr">4<small>advent</small><div class="lock"><img src="<?php bloginfo('template_url') ?>/assets/img/lock.png"/></div></div>
    <?php else : ?>
        <div class="advent-div active">
            <div class="adv_cal_nr">4<small>advent</small><div class="lock"><div class="thumbnail-wrapper"><img src="http://img.youtube.com/vi/<?php echo get_option('osq_cal_adv_4') ?>/sddefault.jpg"/></div></div></div>
        <?php endif; ?>
            <?php if($array[4]) :  ?>
                <iframe src="https://www.youtube.com/embed/<?php echo get_option('osq_cal_adv_4'); ?>" frameborder="0" allowfullscreen></iframe>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

