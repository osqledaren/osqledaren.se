<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function h5ab_snow_flurry_update_settings() {

$snowFlurryMaxSize = ( isset ( $_POST['SnowFlurryMaxSize'] ) ) ? trim(strip_tags($_POST['SnowFlurryMaxSize'])) : null;
$SnowFlurryNumberFlakes = ( isset ( $_POST['SnowFlurryNumberFlakes'] ) ) ? trim(strip_tags($_POST['SnowFlurryNumberFlakes'])) : null;
$snowFlurryMinSpeed = ( isset ( $_POST['SnowFlurryMinSpeed'] ) ) ? trim(strip_tags($_POST['SnowFlurryMinSpeed'])) : null;
$snowFlurryMaxSpeed = ( isset ( $_POST['SnowFlurryMaxSpeed'] ) ) ? trim(strip_tags($_POST['SnowFlurryMaxSpeed'])) : null;
$snowFlurryColor = ( isset ( $_POST['SnowFlurryColor'] ) ) ? trim(strip_tags($_POST['SnowFlurryColor'])) : null;
$snowFlurryTimeout = ( isset ( $_POST['SnowFlurryTimeout'] ) ) ? trim(strip_tags($_POST['SnowFlurryTimeout'])) : null;

$snowFlurryMaxSize = sanitize_text_field($snowFlurryMaxSize);
$SnowFlurryNumberFlakes = sanitize_text_field($SnowFlurryNumberFlakes);
$snowFlurryMinSpeed = sanitize_text_field($snowFlurryMinSpeed);
$snowFlurryMaxSpeed = sanitize_text_field($snowFlurryMaxSpeed);
$snowFlurryColor = sanitize_text_field($snowFlurryColor);
$snowFlurryTimeout = sanitize_text_field($snowFlurryTimeout);

$h5abSnowFlurryArray = array(
    'h5abSnowFlurryMaxSize' => $snowFlurryMaxSize,
    'h5abSnowFlurryNumberFlakes' => $SnowFlurryNumberFlakes,
    'h5abSnowFlurryMinSpeed' => $snowFlurryMinSpeed,
    'h5abSnowFlurryMaxSpeed' => $snowFlurryMaxSpeed,
    'h5abSnowFlurryColor' => $snowFlurryColor,
    'h5abSnowFlurryTimeout' => $snowFlurryTimeout
);

update_option( 'h5abSnowFlurryV2Array', $h5abSnowFlurryArray );

}

?>
