var $ = require("jquery");

$(document).ready(function(){

    $('#adv_cal_wrapper div').click(function() {
        $('#adv_cal_wrapper div').removeClass('active');
        $(this).toggleClass('active');
    });

});
