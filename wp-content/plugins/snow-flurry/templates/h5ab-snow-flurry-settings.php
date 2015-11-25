<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$h5abSnowFlurryArray = get_option('h5abSnowFlurryV2Array');

if (get_option('h5abSnowFlurryV2Array')) {} else {
    
    $snowFlurryMaxSize = wp_strip_all_tags(5);
    $snowFlurryNumberFlakes = wp_strip_all_tags(25);
    $snowFlurryMinSpeed = wp_strip_all_tags(10);
    $snowFlurryMaxSpeed = wp_strip_all_tags(15);
    $snowFlurryColor = wp_strip_all_tags('#fff');
    $snowFlurryTimeout = wp_strip_all_tags(0);

    $snowFlurryMaxSize = sanitize_text_field($snowFlurryMaxSize);
    $snowFlurryNumberFlakes = sanitize_text_field($snowFlurryNumberFlakes);
    $snowFlurryMinSpeed = sanitize_text_field($snowFlurryMinSpeed);
    $snowFlurryMaxSpeed = sanitize_text_field($snowFlurryMaxSpeed);
    $snowFlurryColor = sanitize_text_field($snowFlurryColor);
    $snowFlurryTimeout = sanitize_text_field($snowFlurryTimeout);

    $h5abSnowFlurryArray = array(
        'h5abSnowFlurryMaxSize' => $snowFlurryMaxSize,
        'h5abSnowFlurryNumberFlakes' => $snowFlurryNumberFlakes,
        'h5abSnowFlurryMinSpeed' => $snowFlurryMinSpeed,
        'h5abSnowFlurryMaxSpeed' => $snowFlurryMaxSpeed,
        'h5abSnowFlurryColor' => $snowFlurryColor,
        'h5abSnowFlurryTimeout' => $snowFlurryTimeout
    );

    add_option('h5abSnowFlurryV2Array', $h5abSnowFlurryArray);
        ?>
        <script>location.reload();</script>
        <?php
    }

?>

<form id="h5ab-snow-flurry" method="post" enctype="multipart/form-data">
<h2>Snow Flurry Settings</h2>

<table class="form-table" width="100%" cellpadding="10">
<tbody>

<tr>
<td scope="row" align="left">
<label>Max Snow Flake Size (px): </label>
<br/>
<input type="text" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryMaxSize']); ?>' name="SnowFlurryMaxSize" maxlength="25"/>
<br/>
<label style="font-size: 0.75em;">Max Entry Value 10 (px)</label>
</td>
</tr>

<tr>
<td scope="row" align="left">
<label>Number of Flakes: </label>
<br/>
<input type="text" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryNumberFlakes']); ?>' name="SnowFlurryNumberFlakes" maxlength="25"/>
<br/>
<label style="font-size: 0.75em;">Recommended Maximum of 25</label>
</td>
</tr>

<tr>
<td scope="row" align="left">
<label>Snow Flake Minimum Speed (value) Seconds - Top to Bottom Speed: </label>
<br/>
<input type="text" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryMinSpeed']); ?>' name="SnowFlurryMinSpeed" maxlength="25"/><br/>
<label style="font-size: 0.75em;">Must be less than Snow Flake Maximum Speed</label>
</td>
</tr>

<tr>
<td scope="row" align="left">
<label>Snow Flake Maximum Speed (value) Seconds - Top to Bottom Speed: </label>
<br/>
<input type="text" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryMaxSpeed']); ?>' name="SnowFlurryMaxSpeed" maxlength="25"/>
<br/>
<label style="font-size: 0.75em;">Must be Greater than Snow Flake Minimum Speed</label>
</td>
</tr>

<tr>
<td scope="row" align="left">
<label>Snow Flake Color (HTML Color): </label>
<br/>
<input type="text" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryColor']); ?>' name="SnowFlurryColor" maxlength="25"/>
</td>
</tr>

<tr>
<td scope="row" align="left">
<label>Disable Snow Flakes After (Seconds): </label>
<br/>
<input type="text" value='<?php echo esc_attr($h5abSnowFlurryArray['h5abSnowFlurryTimeout']); ?>' name="SnowFlurryTimeout" maxlength="25"/>
</td>
</tr>

<tr>
<td scope="row" align="left">

<?php
wp_nonce_field('H5AB_Snow_Flurry_upload_nonce','H5AB_Snow_Flurry_upload_n');

if ( ! is_admin() ) {
echo 'Only Admin Users Can Update These Options';
} else {
echo '<input type="submit" class="button button-primary" id="h5ab_snow_flurry_submit" name="h5ab_snow_flurry_submit" value="Save Settings" />';
}
?>

</td>
</tr>


</tbody>
</table>

</form>

<div class="h5ab-affiliate-advert">
                    <p style="margin: 0; text-align: center;">Advertisement</p>
                    <a href="http://themeover.com/microthemer?ap_id=html5andbeyond" target="_blank"><img src="<?php echo esc_url(plugins_url( '../images/MT_300x250.png', __FILE__ )) ?>" border="0" style="max-width: 100%; height: auto;" /></a>
                    <p style="margin: 0;">*Affiliate Link</p>

</div>

<hr/>

<div style="background-color: #ddd; width: 98%; padding: 0 5px;">
<p>*Affiliate Link - We (Plugin Authors) earn commission on sales generated through this link - We also use it ourselves and love the service.</p>
</div>
