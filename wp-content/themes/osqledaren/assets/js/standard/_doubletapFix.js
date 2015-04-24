var $ = require("jquery");

module.exports = function(){
   $('header#header .go_home').on('click touchend', function() {
      var el = $(this);
      var link = el.attr('href');
      window.location = link;
   });
}