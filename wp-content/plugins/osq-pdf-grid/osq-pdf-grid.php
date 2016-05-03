<?php
/**
* Plugin Name: osq-pdf-grid
* Plugin URI: http://osqledaren.se/
* Description: Arranges issues of osqledaren in a grid
* Version: 1.0
* Author: Osqledaren IT-group
* Author URI: osqledaren.se
* License: A "Slug" license name e.g. GPL12
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu() {
	add_menu_page('Issues Settings', 'Issues', 'administrator', 'my-plugin-settings', 'my_plugin_settings_page', 'dashicons-admin-generic');
}

function my_plugin_settings() {
    $startYear = 2010;
    $totalYears = date("Y") - $startYear;

    for ($i = 0; $i < $totalYears; $i++) {
        $currentYear = $startYear + $i;
        for ($j = 0; $j < 4; $j++) {
            register_setting( 'osq-pdf-grid-settings-group', 'issue_' + $currentYear + '_' + $j );
        }
    }
}

function my_plugin_settings_page() {
    $startYear = 2010;
    $totalYears = date("Y") - $startYear;
    ?>
    <div class="wrap">
    <h2>Issues</h2>

    <form method="post" action="options.php">
        <?php settings_fields( 'osq-pdf-grid-settings-group' ); ?>
        <?php do_settings_sections( 'osq-pdf-grid-settings-group' ); ?>
        <table class="form-table">
            <?php
            echo "" + $totalYears;
            for ($i = $totalYears; $i > 0; $i--) {
                $currentYear = $startYear + $i;
                ?>
                <tr valign="top">
                <th scope="row">Year: <?php echo $currentYear + ""?></th>
                <?php
                    for ($j = 0; $j < 4; $j++) {
                        $issue = esc_attr( get_option('issue_' + $currentYear + '_' + $j) );
                        ?>
                        <td>
                            <input type="text" name="<?php echo $issue ?>" value="<?php echo $issue ?>"/>
                        </td>
                        <?php
                    }
                ?>

                </tr>
                <?php
            }
            ?>
        </table>

        <?php submit_button(); ?>

    </form>
    </div>
    <?php
}

?>
