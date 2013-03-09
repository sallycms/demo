jQuery(function($) {
	// init Fancybox links
	$('.fancybox').fancybox({
		prevEffect: 'none',
		nextEffect: 'none',
		closeBtn  : true,
		arrows    : true,
		helpers   : {
			title  : {
				type: 'inside'
			},
			buttons: { }
		}
	});

	// toggle additional gallery images
	$('.extend a').on('click', function() {
		var
			self    = $(this),
			gallery = self.closest('.gallery'),
			alt     = self.data('alt');

		gallery.find('.bottom').slideToggle('slow');
		gallery.find('.info').toggle();

		// change link text
		self.data('alt', self.text()).text(alt);

		return false;
	});

	// hide teasers by default
	$('.newslist .teaser').hide();

	// toggle teasers on click on their title
	$('.newslist .title a').on('click', function() {
		$(this).closest('li').find('.teaser').slideToggle('slow');
		return false;
	});

	// hide all keyvisuals except the first one
	$('#keyvisual div').not(':first').hide();

	// toggle keyvisuals every 5 seconds
	setInterval(function() {
		$('#keyvisual > div:first')
			.fadeOut(1000)
			.next().fadeIn(1000)
			.end()
			.appendTo('#keyvisual');
	}, 5000);
});
