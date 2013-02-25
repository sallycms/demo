jQuery(function($) {
	$(".fancybox-button").fancybox({
		prevEffect		: 'none',
		nextEffect		: 'none',
		closeBtn		: true,
		arrows			: true,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});
	$(".preview").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: true,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});

	$('.extender').click(function() {
		$('.bottom_images').slideToggle("slow", function() {
		});
		$('.clicker, #extenderInfo').toggle(0, function() {
  		});
	});
});
