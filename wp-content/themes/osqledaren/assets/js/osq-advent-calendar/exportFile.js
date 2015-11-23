var $ = require("jquery");

$(document).ready(function(){

    $.fn.snow();

    $('#adv_cal_wrapper div').click(function() {
        $('#adv_cal_wrapper div').removeClass('active');
        $(this).toggleClass('active');
    });

});


