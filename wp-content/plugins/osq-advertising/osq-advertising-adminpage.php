<?php
if ( ! current_user_can( 'manage_options' ) ) {
    die( 'Access Denied' );
}
if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    global $osq_adv_uploaddir;
    global $osq_adv_uploadurl;

    $request_data = $_POST;

    //Either wants to remove or update:
    if( isset($_POST["remove"])){
        osq_adv_remove_ad($request_data);
    } else {
        osq_update_ad($request_data, $_FILES["file"]);
 
    }
}
?>
<div class="wrap">
    <h2>Osqledarens Reklam</h2>
    <p>Världens enklaste plugin för att infoga bilder med länkar.</p>
    <div class="error">
        <p>Det är endast möjligt att uppdatera en annons i taget! </p>
    </div>

     
<?php
$ad_locations = ["banner","articles"];
$ad_options = get_option("osq_adv");

 foreach($ad_locations as $ad_location){
    $location = $ad_location;
    $url    = isset($ad_options[$ad_location]["url"]    )? $ad_options[$ad_location]["url"]    : "";
    $target = isset($ad_options[$ad_location]["target"] )? $ad_options[$ad_location]["target"] : "";

 ?>
    <form method="post" action="" enctype="multipart/form-data">
        <h3> "<?php echo $location ?>"-advertisement:</h3>
            <input type="hidden" name="location" value="<?php echo $location ?>">
            <input id="url" type="text" placeholder="<?php echo $url ?>" disabled="disabled">
            <input type="file" name="file" id="file"></br>

            <input class="regular-text" type="text" name="target" id="target" placeholder="Vart ska den länkas?" value="<?php echo $target ?>">
        </br>
            <button class="button-secondary" type="submit" name="remove" value="banner"<?php if(! isset($ad_options[$ad_location])) echo "disabled='disabled'" ?>> Radera </button>
            <button class="button-primary" type="submit" name="submit" value="banner"/> Updatera </button>
    </form>
    <?php } ?>
</div>

<script>
    document.getElementById("file").onchange = function () {
        document.getElementById("url").value = this.value;
};
</script>
