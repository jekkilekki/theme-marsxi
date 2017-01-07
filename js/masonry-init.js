
//Masonry init
jQuery(function($) {
	var $container = $('.grid-layout');
	$container.imagesLoaded( function() {
		$container.masonry({
			itemSelector: '.hentry',
	        isAnimated: true,
            columnWidth: 380,
            isFitWidth: true,
			animationOptions: {
				duration: 300,
				easing: 'linear',
			}
	    });
	});
});