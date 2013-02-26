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
	$('.extender').click(function() {
		$('.bottom_images').slideToggle("slow", function() {
		});
		$('.clicker, #extenderInfo').toggle(0, function() {
  		});
	});

	$('.newslist_title').not('.newslist_title_active').next('.newslist_preview').hide();
	$('.newslist_title').click( function() {
		var trig = $(this);
		if ( trig.hasClass('newslist_title_active') ) {
			trig.next('.newslist_preview').slideToggle('slow');
			trig.removeClass('newslist_title_active');
		} else {
			$('.newslist_title_active').next('.newslist_preview').slideToggle('slow');
			$('.newslist_title_active').removeClass('newslist_title_active');
			trig.next('.newslist_preview').slideToggle('slow');
			trig.addClass('newslist_title_active');
		};
		return false;
	});
});
