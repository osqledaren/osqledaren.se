/*! modernizr 3.1.0 (Custom Build) | MIT *
 * http://modernizr.com/download/?-csstransitions-touchevents !*/
!function(e,n,t){function o(e,n){return typeof e===n}function r(){var e,n,t,r,s,i,a;for(var l in C)if(C.hasOwnProperty(l)){if(e=[],n=C[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(r=o(n.fn,"function")?n.fn():n.fn,s=0;s<e.length;s++)i=e[s],a=i.split("."),1===a.length?Modernizr[a[0]]=r:(!Modernizr[a[0]]||Modernizr[a[0]]instanceof Boolean||(Modernizr[a[0]]=new Boolean(Modernizr[a[0]])),Modernizr[a[0]][a[1]]=r),g.push((r?"":"no-")+a.join("-"))}}function s(e){var n=_.className,t=Modernizr._config.classPrefix||"";if(x&&(n=n.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(o,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),x?_.className.baseVal=n:_.className=n)}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):x?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function a(){var e=n.body;return e||(e=i(x?"svg":"body"),e.fake=!0),e}function l(e,t,o,r){var s,l,f,u,c="modernizr",d=i("div"),p=a();if(parseInt(o,10))for(;o--;)f=i("div"),f.id=r?r[o]:c+(o+1),d.appendChild(f);return s=i("style"),s.type="text/css",s.id="s"+c,(p.fake?p:d).appendChild(s),p.appendChild(d),s.styleSheet?s.styleSheet.cssText=e:s.appendChild(n.createTextNode(e)),d.id=c,p.fake&&(p.style.background="",p.style.overflow="hidden",u=_.style.overflow,_.style.overflow="hidden",_.appendChild(p)),l=t(d,e),p.fake?(p.parentNode.removeChild(p),_.style.overflow=u,_.offsetHeight):d.parentNode.removeChild(d),!!l}function f(e,n){return!!~(""+e).indexOf(n)}function u(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function c(e,n){return function(){return e.apply(n,arguments)}}function d(e,n,t){var r;for(var s in e)if(e[s]in n)return t===!1?e[s]:(r=n[e[s]],o(r,"function")?c(r,t||n):r);return!1}function p(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function m(n,o){var r=n.length;if("CSS"in e&&"supports"in e.CSS){for(;r--;)if(e.CSS.supports(p(n[r]),o))return!0;return!1}if("CSSSupportsRule"in e){for(var s=[];r--;)s.push("("+p(n[r])+":"+o+")");return s=s.join(" or "),l("@supports ("+s+") { #modernizr { position: absolute; } }",function(e){return"absolute"==getComputedStyle(e,null).position})}return t}function h(e,n,r,s){function a(){c&&(delete j.style,delete j.modElem)}if(s=o(s,"undefined")?!1:s,!o(r,"undefined")){var l=m(e,r);if(!o(l,"undefined"))return l}for(var c,d,p,h,v,y=["modernizr","tspan"];!j.style;)c=!0,j.modElem=i(y.shift()),j.style=j.modElem.style;for(p=e.length,d=0;p>d;d++)if(h=e[d],v=j.style[h],f(h,"-")&&(h=u(h)),j.style[h]!==t){if(s||o(r,"undefined"))return a(),"pfx"==n?h:!0;try{j.style[h]=r}catch(g){}if(j.style[h]!=v)return a(),"pfx"==n?h:!0}return a(),!1}function v(e,n,t,r,s){var i=e.charAt(0).toUpperCase()+e.slice(1),a=(e+" "+T.join(i+" ")+i).split(" ");return o(n,"string")||o(n,"undefined")?h(a,n,r,s):(a=(e+" "+P.join(i+" ")+i).split(" "),d(a,n,t))}function y(e,n,o){return v(e,t,t,n,o)}var g=[],C=[],w={_version:"3.1.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){C.push({name:e,fn:n,options:t})},addAsyncTest:function(e){C.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=w,Modernizr=new Modernizr;var _=n.documentElement,x="svg"===_.nodeName.toLowerCase(),S=w._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):[];w._prefixes=S;var b=w.testStyles=l;Modernizr.addTest("touchevents",function(){var t;if("ontouchstart"in e||e.DocumentTouch&&n instanceof DocumentTouch)t=!0;else{var o=["@media (",S.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");b(o,function(e){t=9===e.offsetTop})}return t});var z="Moz O ms Webkit",T=w._config.usePrefixes?z.split(" "):[];w._cssomPrefixes=T;var P=w._config.usePrefixes?z.toLowerCase().split(" "):[];w._domPrefixes=P;var E={elem:i("modernizr")};Modernizr._q.push(function(){delete E.elem});var j={style:E.elem.style};Modernizr._q.unshift(function(){delete j.style}),w.testAllProps=v,w.testAllProps=y,Modernizr.addTest("csstransitions",y("transition","all",!0)),r(),s(g),delete w.addTest,delete w.addAsyncTest;for(var N=0;N<Modernizr._q.length;N++)Modernizr._q[N]();e.Modernizr=Modernizr}(window,document);

/*
Copyright (c) 2014 Matthew Hudson - MIT License
device.js 0.1.61
*/
(function(){var a,b,c,d,e,f,g,h,i,j;a=window.device,window.device={},c=window.document.documentElement,j=window.navigator.userAgent.toLowerCase(),device.ios=function(){return device.iphone()||device.ipod()||device.ipad()},device.iphone=function(){return d("iphone")},device.ipod=function(){return d("ipod")},device.ipad=function(){return d("ipad")},device.android=function(){return d("android")},device.androidPhone=function(){return device.android()&&d("mobile")},device.androidTablet=function(){return device.android()&&!d("mobile")},device.blackberry=function(){return d("blackberry")||d("bb10")||d("rim")},device.blackberryPhone=function(){return device.blackberry()&&!d("tablet")},device.blackberryTablet=function(){return device.blackberry()&&d("tablet")},device.windows=function(){return d("windows")},device.windowsPhone=function(){return device.windows()&&d("phone")},device.windowsTablet=function(){return device.windows()&&d("touch")&&!device.windowsPhone()},device.fxos=function(){return(d("(mobile;")||d("(tablet;"))&&d("; rv:")},device.fxosPhone=function(){return device.fxos()&&d("mobile")},device.fxosTablet=function(){return device.fxos()&&d("tablet")},device.meego=function(){return d("meego")},device.cordova=function(){return window.cordova&&"file:"===location.protocol},device.nodeWebkit=function(){return"object"==typeof window.process},device.mobile=function(){return device.androidPhone()||device.iphone()||device.ipod()||device.windowsPhone()||device.blackberryPhone()||device.fxosPhone()||device.meego()},device.tablet=function(){return device.ipad()||device.androidTablet()||device.blackberryTablet()||device.windowsTablet()||device.fxosTablet()},device.desktop=function(){return!device.tablet()&&!device.mobile()},device.portrait=function(){return window.innerHeight/window.innerWidth>1},device.landscape=function(){return window.innerHeight/window.innerWidth<1},device.noConflict=function(){return window.device=a,this},d=function(a){return-1!==j.indexOf(a)},f=function(a){var b;return b=new RegExp(a,"i"),c.className.match(b)},b=function(a){return f(a)?void 0:c.className+=" "+a},h=function(a){return f(a)?c.className=c.className.replace(a,""):void 0},device.ios()?device.ipad()?b("ios ipad tablet"):device.iphone()?b("ios iphone mobile"):device.ipod()&&b("ios ipod mobile"):b(device.android()?device.androidTablet()?"android tablet":"android mobile":device.blackberry()?device.blackberryTablet()?"blackberry tablet":"blackberry mobile":device.windows()?device.windowsTablet()?"windows tablet":device.windowsPhone()?"windows mobile":"desktop":device.fxos()?device.fxosTablet()?"fxos tablet":"fxos mobile":device.meego()?"meego mobile":device.nodeWebkit()?"node-webkit":"desktop"),device.cordova()&&b("cordova"),e=function(){return device.landscape()?(h("portrait"),b("landscape")):(h("landscape"),b("portrait"))},i="onorientationchange"in window,g=i?"orientationchange":"resize",window.addEventListener?window.addEventListener(g,e,!1):window.attachEvent?window.attachEvent(g,e):window[g]=e,e()}).call(this);

/*
snowFlurry JS - version 2.0
Copyright © 2015 S.W. Clough (https://www.html5andbeyond.com)
Licensed Under MIT
*/

(function ( $ ) {

    $.fn.snowFlurry = function( options ) {

        var s = $.extend({
            maxSize: 5,
            numberOfFlakes: 25,
            minSpeed: 10,
			maxSpeed: 15,
            color: '#fff',
            timeout: 0
        }, options );

        var windowWidth = $(window).innerWidth(),
            WidthArray = [],
            DelayArray = [],
            animateArray = [],
            flakeSize = [],
            snowInterval;

        if (s.maxSize <= 10) {
			for (var i = 1; i < s.maxSize; i++) {
			flakeSize.push(i);
			}
        } else {
            for (var i = 1; i < 10; i++) {
			flakeSize.push(i);
			}
        }

        for(var i=0; i < windowWidth - 20; i++) {
            WidthArray.push(i);
        }

        for(var i=0; i<s.numberOfFlakes; i++) {
            $('<div class="sf-snow-flake"></div>').appendTo('body');
        }

        for(var i=0; i<10; i++) {
            DelayArray.push(i);
        }

        for(var i=s.minSpeed; i<s.maxSpeed; i++) {
            animateArray.push(i);
        }

        function getRandomFlakeSize() {
            var item = flakeSize[Math.floor(Math.random()*flakeSize.length)];
            return item;
        }

        function getRandomPosition() {
            var item = WidthArray[Math.floor(Math.random()*WidthArray.length)];
            return item;
        }

        function getRandomDelay() {
            var item = DelayArray[Math.floor(Math.random()*DelayArray.length)];
            return item * 1000;
        }

        function getRandomAnimation() {
            var item = animateArray[Math.floor(Math.random()*animateArray.length)];
            return item * 1000;
        }

        $('.sf-snow-flake').each(function(){

        var elem = $(this);

        elem.attr('data-speed', getRandomAnimation());
        elem.attr('data-delay', getRandomDelay());

        var elemSpeed = elem.attr('data-speed'),
            elemDelay = elem.attr('data-delay');

        var flakeSize = getRandomFlakeSize();

        elem.css({
            'width': flakeSize,
            'height': flakeSize,
            'border-radius': flakeSize / 2,
            'background-color': s.color,
            'box-shadow': '0 0 2px 1px' + s.color
        })

        function activateAnim() {
            setTimeout(function(){
                elem.css('left', getRandomPosition());
                elem.addClass('sf-snow-anim');
                elem.css('transition', 'top ' + elemSpeed / 1000 + 's linear');

                setTimeout(function(){
                    elem.css('transition', '');
                    elem.removeClass('sf-snow-anim');
                }, elemSpeed);

            }, elemDelay);
        }

        if (device.mobile() || device.tablet() || Modernizr.touch || $('html').hasClass('no-csstransitions')) {} else if (device.desktop()) {
            activateAnim();

            snowInterval = setInterval(function(){
               activateAnim();
            }, +elemDelay + +elemSpeed);
        }

        if (s.timeout != 0) {
            setTimeout(function(){
                clearInterval(snowInterval);
                $('.sf-snow-flake').fadeOut(1500, function(){
                    $(this).remove();
                })
            }, s.timeout * 1000);
        }

        });

    };

}( jQuery ));
