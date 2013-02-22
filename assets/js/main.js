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
	function slideSwitch() {
    	var $active = $('.slideshow img.active');
    	var $next = $active.next();    
    
    	$next.addClass('active');
    
   		$active.removeClass('active');
	}

	$(function() {
    	setInterval( "slideSwitch()", 5000 );
	});
});
