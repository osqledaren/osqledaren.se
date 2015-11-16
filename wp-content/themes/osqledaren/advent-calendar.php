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
    <iframe src="<?php echo get_option('osq_cal_adv_1'); ?>" width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    <iframe src="<?php echo get_option('osq_cal_adv_2'); ?>" width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    <iframe src="<?php echo get_option('osq_cal_adv_3'); ?>" width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    <iframe src="<?php echo get_option('osq_cal_adv_4'); ?>" width="853" height="480" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
</div>

<?php get_footer(); ?>
