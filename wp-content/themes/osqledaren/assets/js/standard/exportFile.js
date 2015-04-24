var $ = require("jquery");

var advertisingPage = require("./_advertisingPage.js");
var doubletapFix = require("./_doubletapFix");
var goToTop = require("./_goToTop.js");
var header = require("./_header.js");
var searchbox = require("./_searchbox.js");
var article = require("./_article.js");

$(document).ready(function(){
	advertisingPage();
	doubletapFix()
	goToTop()
	header()
	searchbox()
	article();
});