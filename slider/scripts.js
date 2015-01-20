(function ($) {
		var sliderUl = $('div.slider').css('overflow','hidden').children('ul'),
		imgs = sliderUl.find('img'),
		imgWidth = imgs[0].width,
		imgLen = imgs.length,
		current = 1,
		totalImgsWidth = imgLen * imgWidth;
		$('#slider-nav').show().find('button').on('click', function () {
			var direction = $(this).data('dir'),
				loc=imgWidth;

			// Update current value
			(direction === "next") ? ++current : --current;
			if (current === 0) {
				current = imgLen;
				loc = totalImgsWidth - imgWidth;
				direction = 'next';

			}else if (current - 1 === imgLen) {
				current = 1;
				loc = 0;
			}
			transition(sliderUl,loc,direction);

		});
		function transition (container, loc, direction) {
			var unit;
			if (direction && loc !== 0){
				unit = (direction === 'next') ? '-=' : '+=';
			}
			container.animate({
				'margin-left': unit ? (unit + loc) : loc
			})
		}
})(jQuery);