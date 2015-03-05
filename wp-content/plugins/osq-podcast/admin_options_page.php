<div class="wrap">

<?php

if($_POST['osqpod_hidden'] == "Y") {
    //Form data sent
    $osqpod_podcasts = $_POST['osqpod_podcasts'];
    update_option('osqpod_podcasts', $osqpod_podcasts); ?>
    <div class="updated"><p><strong>Options saved</strong></p></div>
<?php 
    } else{
        $osqpod_podcasts = get_option("osqpod_podcasts");
    }
    if($_POST["refresh"]){ 
        osqpod_parse_rss();     ?>
    <div class="updated"><p></strong>Plugin refreshing. It may take minutes so hold on.</strong></p></div>
<?php } ?>
    <h2>Osqledaren Podcasts</h2>
     
    <form name="osqpod_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="osqpod_hidden" value="Y">
        <h4> What podcasts should be showed? (Libsyn-rss links separated by "," ONLY.)</h4>
        <h4> Example: "http://abc.def,http://libsyn.com/rss,http://osv.com" </h4>
        <p>
            <input type="text" name="osqpod_podcasts" value="<?php echo $osqpod_podcasts; ?>" size="100">
        </p>
        <p class="submit">
            <input type="submit" name="Submit" value="Update" />
        </p>
    </form>

    <form name="osqpod_refresh" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <h4> Did you accidentally delete any files? This button will force the plugin to parse once clicked.</h4>
        <input type="submit" name="refresh" value="RESET PLXXX">
    </form>
</div>