(function ($) {
	"use strict";
	$(function () {
		// Place your public-facing JavaScript here
		var access_key = cp_scripts.access_key;
		var print_button_position = cp_scripts.print_button_position;
		var print_button_color = cp_scripts.print_button_color;

		$('body').after('<div id="cp-store-root" data-cp-settings=\'{ "access_key": "' + access_key + '", "modal": true }\'></div>');

		var src = '';
		$('.cp img:not(.ignore)').each(function( index ) {

			if ($(this).parent('a').attr('href')) {
				src = $(this).parent('a').attr('href');
			}else{
				src = $(this).attr('src');
			}
			$(this).wrap('<div class="cp-img--container"></div>');

			$(this).after('<br/><a href="#" data-cp-url="' + src + '" class="cp-btn btn btn-primary cp-btn--' + print_button_position + '" style="background-color:#' + print_button_color + '">Print on Canvas</a>');
		});

	});

}(jQuery));

(function ( d, s, id ) {
	var js, cpJs = d.getElementsByTagName( s )[0];
	if ( d.getElementById( id ) ) return;
	js = d.createElement( s );
	js.id = id;
	js.setAttribute( 'data-cp-url', 'https://developers.canvaspop.com' );
	js.src = 'https://store.canvaspop.com/static/js/cpopstore.js';
	cpJs.parentNode.insertBefore( js, cpJs );
}( document, 'script', 'canvaspop-jssdk' ));
