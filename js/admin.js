(function ($) {
	"use strict";
	$(function () {
		// Place your administration-specific JavaScript here
		var hex = $('.colorpick').val();
		$('.color').css('backgroundColor', '#' + hex);
		
		$('.colorpick').ColorPicker({
			onChange: function (hsb, hex, rgb) {
				$('.color').css('backgroundColor', '#' + hex);
				$('.colorpick').val(hex);
			}
		});
		
		$('.colorpick').keyup(function() {
			var val = $(this).val();
			var length = val.length;
			if(length == 6){
				$('.color').css('backgroundColor', '#' + val);
			}
		});
	});
}(jQuery));