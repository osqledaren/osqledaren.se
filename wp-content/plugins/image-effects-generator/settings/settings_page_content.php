<div class="wrap">
<h2>Image Effects Generator</h2>
<h4>Choose which effects you would like to generate upon every image upload:</h4>

<form method="post" action="options.php">
    <?php settings_fields( 'image-effects-settings-group' ); ?>
    <?php do_settings_sections( 'image-effects-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Black and White</th>
        <?php $my_options = get_option('black_and_white'); ?>
        <td><input type="checkbox" name="black_and_white" <?php if ($my_options == 'yes_please') echo "checked='checked'"; ?> value="yes_please"></td>
        </tr>

        <tr valign="top">
        <th scope="row">Blurred</th>
        <?php $my_options = get_option('blurred'); ?>
        <td><input type="checkbox" name="blurred" <?php if ($my_options == 'yes_please') echo "checked='checked'"; ?> value="yes_please"></td>
        </tr>

        <tr valign="top">
        <th scope="row">Sharpened</th>
        <?php $my_options = get_option('sharpened'); ?>
        <td><input type="checkbox" name="sharpened" <?php if ($my_options == 'yes_please') echo "checked='checked'"; ?> value="yes_please"></td>
        </tr>

        <tr valign="top">
        <th scope="row">Sepia</th>
        <?php $my_options = get_option('sepia'); ?>
        <td><input type="checkbox" name="sepia" <?php if ($my_options == 'yes_please') echo "checked='checked'"; ?> value="yes_please"></td>
        </tr>

        <tr valign="top">
        <th scope="row">Pixelate (13px)</th>
        <?php $my_options = get_option('pixelate'); ?>
        <td><input type="checkbox" name="pixelate" <?php if ($my_options == 'yes_please') echo "checked='checked'"; ?> value="yes_please"></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Negative</th>
        <?php $my_options = get_option('negative'); ?>
        <td><input type="checkbox" name="negative" <?php if ($my_options == 'yes_please') echo "checked='checked'"; ?> value="yes_please"></td>
        </tr>

    </table>
    
    <?php submit_button(); ?>

</form>
</div>