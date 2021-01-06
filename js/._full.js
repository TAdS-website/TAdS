$(function(){
	var effects = 'animated pulse';
	var effectsEnd = 'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd';

	$('div.row justify-content-center').hover(function() {
		$(this).addClass(effects).one(effectsEnd, function(){
			$(this).removeClass(effects);
		});

	});
}); 