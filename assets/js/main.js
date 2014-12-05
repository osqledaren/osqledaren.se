/* Author: Nadan Gergeo

*/
 
 // Retina Images from http://retina-images.complexcompulsions.com/
document.cookie='devicePixelRatio='+((window.devicePixelRatio === undefined) ? 1 : window.devicePixelRatio)+'; path=/';

// Rather than waiting for document ready, where the images
// have already loaded, we'll jump in as soon as possible.
$(window).on("load", function() {
    //run the function on the .hentry element ( covers both .post or .page )
    cleanImg('.hentry');

    // IE 7 och nedåt har inte stöd för :before så ikoner syns inte
    // Därför stoppar vi inte text istället
    jQuery('.lt-ie8').each(function() {
        $('.iconlinks .facebook').append('Facebook');
        $('.iconlinks .twitter').append('Twitter');
        $('.iconlinks .instagram').append('Instagram');
        $('.iconlinks .feed').append('RSS');
    });

});

// fixar en äcklig bugg i IE9 och nedåt.
function cleanImg(el) {
    jQuery('.lt-ie10').each(function() {
        jQuery(el + ' img').each(function() {

            // get image width & height attributes
            var imgh = jQuery(this).attr('height');
            var imgw = jQuery(this).attr('width');
            //find width of the .hentry parent div
            var postw = jQuery(el).width();

            if ((imgh == null && imgw == null) || imgw >= 740)
                return;
            
            // Test for existence of .wp-caption
            if (jQuery(this).parent('.wp-caption').length > 0) {
                // Remove the width & height values from the image (img)
                jQuery(this).removeAttr('width').removeAttr('height');
                // Set capw to equal the width of the .wp-caption div
                var capw = jQuery('.wp-caption').width();
                // Remove the style attribute from .wp-caption
                jQuery('.wp-caption').removeAttr('style');
                // Calculate the width of .wp-caption as a percentage of the width of .hentry
                var caperc = ((capw / postw) * 100);
                // Write a style attribute with width as a percentage
                //jQuery('.wp-caption').attr('style','width:' + caperc + '%;');

                // Write a style attribute with the width
                jQuery('.wp-caption').attr('style','width:' + capw + 'px;');
                
            } else {

                //Remove the width & height attributes. If the image width exceeds the .hentry container, set style attribute to width:100%
                if (imgw > postw) { 
                    jQuery(this).removeAttr('width').removeAttr('height').attr('style','width="97%;');
                }
                
                //Remove the width & height attributes. If the image width is narrower than the width of the .hentry element, calculate the width of the image as a percentage of the width of .hentry, set style attribute to width:% If the image is part of a WordPress gallery, take the .gallery-icon element into account.

                var gal = jQuery(this).closest('.gallery-icon');
                var galw = jQuery(gal).width();

                if ( (imgw < postw) && jQuery(gal).length > 0 ) { 
    //              jQuery(gal).css('background','red');
                    var gperc = ((imgw / galw) * 100);
                    
                    //jQuery(this).removeAttr('width').removeAttr('height').attr('style','width:' + gperc + '%;');
                    jQuery(this).removeAttr('width').removeAttr('height').attr('style','width:' + imgw + 'px; height:auto;');
                    
                } else {
                    var nperc = ((imgw / postw) * 100);
                    
                    //jQuery(this).removeAttr('width').removeAttr('height').attr('style','width:' + nperc + '%;');
                    jQuery(this).removeAttr('width').removeAttr('height').attr('style','width:' + imgw + 'px; height:auto;');
                }
            }
        });
    });
}

var animationSpeed = 0;

function searchDisplayerOnBlur(){
    if($('#nav-main .menu-item-search').css('display') == 'none'){
        $('#nav-main .menu-item-search').css('display','inline-block');
        $('#s').focus();
        $('#nav-main .menu-item-search-displayer').fadeOut(animationSpeed);
    } else {
        $('#nav-main .menu-item-search').css('display','none');
    }
}

function searchInputOnFocus(searchInput, defaultValue){
    searchInput.style.color='#222';
    if (searchInput.value == defaultValue){
        searchInput.value = '';
    }
}

function searchInputOnBlur(searchInput, defaultValue){
    if($('#nav-main .menu-item-search').width() > 240){
        $('#nav-main .menu-item-search').css('display','none');
        $('#nav-main .menu-item-search-displayer').fadeIn(animationSpeed);
    }

    if (searchInput.value == ''){
        searchInput.value = defaultValue;
    }

    if(searchInput.value == defaultValue){
        searchInput.style.color='#999';
    }
}

/* Google Analytics code */

var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));

function startAnalytics() {
    var pageTracker = _gat._getTracker("UA-1912843-3");
    pageTracker._initData();
    pageTracker._trackPageview();
}

if (window.addEventListener) {
    window.addEventListener('load', startAnalytics, false);
}
else if (window.attachEvent) {
    window.attachEvent('onload', startAnalytics);
}