jQuery(document).ready(function($) {
   cs.utility.init();

   $(window).resize(function(){ cs.utility.resize(); });
   $(window).scroll(function(){ cs.utility.onScroll(); });
});









/*
=============================================================================
	FUNCTION DECLARATIONS
=============================================================================
*/

var cs = (function($) {

	/*
		Utility
		
		Various utility functions that load/unload/route data,
		call other functions, etc.
	*/

	var utility = (function() {

		var debug = false;

		var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );

		var init = function() { // Called on page load, calls all other functions that should occur on page load
			
			// PLUGINS CALLS / DEVICE FIXES
			conditionizr({ // http://conditionizr.com/docs.html
				debug      : false,
				scriptSrc  : 'js/conditionizr/',
				styleSrc   : 'css/conditionizr/',
				ieLessThan : {
					active: true,
					version: '9',
					scripts: false,
					styles: false,
					classes: true,
					customScript: // Separate polyfills with commas
						'//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js, //cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js'
					},
				chrome     : { scripts: false, styles: false, classes: true, customScript: false },
				safari     : { scripts: false, styles: false, classes: true, customScript: false },
				opera      : { scripts: false, styles: false, classes: true, customScript: false },
				firefox    : { scripts: false, styles: false, classes: true, customScript: false },
				ie10       : { scripts: false, styles: false, classes: true, customScript: false },
				ie9        : { scripts: false, styles: false, classes: true, customScript: false },
				ie8        : { scripts: false, styles: false, classes: true, customScript: false },
				ie7        : { scripts: false, styles: false, classes: true, customScript: false },
				ie6        : { scripts: false, styles: false, classes: true, customScript: false },
				retina     : { scripts: false, styles: false, classes: true, customScript: false },
				touch      : { scripts: false, styles: false, classes: true, customScript: false },
				mac        : true,
				win        : true,
				x11        : true,
				linux      : true
			});

			if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) { // Disable scaling until user begins a gesture (prevents zooming when user rotates to landscape mode)
				var viewportmeta = document.querySelector('meta[name="viewport"]');
				if (viewportmeta) {
					viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0';
					document.body.addEventListener('gesturestart', function () {
						viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
					}, false);
				}
			}

			// $("div.twitter.single .tweet").tweet({ // Load a single tweet into any single tweet holder.
			// 	modpath: 'http://ripeserver.com/build/eatcs.com/wp-content/themes/cs-master/js/vendor/twitter/',
			// 	join_text: "auto",
			// 	username: "eatcs",
			// 	avatar_size: 0,
			// 	count: 1,
			// 	auto_join_text_default: " we said, ",
			// 	auto_join_text_ed: " we ",
			// 	auto_join_text_ing: " we were ",
			// 	auto_join_text_reply: " we replied ",
			// 	auto_join_text_url: " we were checking out ",
			// 	loading_text: "Loading Tweets",
			// 	template: "{text}<div class='clear'></div>{time} <div class='actions'>{reply_action} {retweet_action} {favorite_action}</div><div class='clear'></div>"
			// });

			// FUNCTIONS
			uiMod.setFilterHeadlineWidth();

			
			// REPEATING FUNCTIONS
			// var example = setInterval(function(){
			// 	// do stuff
			// }, 200);


			/*
				USER INTERACTION
			*/
			$('.filter a').click(function(){
				userInput.timelineCategoryClick($(this));
			})
			
		};

		var onScroll = function() { // Called when the browser window is scrolled
			// Functions
		};

		var resize = function() { // Called when the browser window is resized
			// Functions
			uiMod.setFilterHeadlineWidth();
		};

		var responsiveState = function(req) { // Returns what responsive state we're at. Values based on CSS media queries.
			// Below is an idiotic bug fix.
			// Chrome & Safari exclude scrollbars from window width for CSS media queries.
			// Firefox, Opera and IE include scrollbars in window width for CSS media queries, but not in JS.
			// So we have to add some px to the window width for Firefox, Opera and IE so that breakpoints
			// match up between CSS and JS. What a world.
			if ($('html').hasClass('chrome') || $('html').hasClass('safari')) {
				var winWidth = $(window).width();
			}
			else {
				var winWidth = $(window).width() + 17;
			}

			if (typeof req === 'undefined' || req === 'state') {
				// MODIFY THESE IF STATEMENTS TO MATCH YOUR RESPONSIVE WIDTHS
				if (winWidth >= 1025) {
					return 'full';
				}
				if (winWidth >= 768 && winWidth <= 1024) {
					return 'compressed';
				}
				if (winWidth <= 767) {
					return 'oneCol';
				}
				// STOP MODIFYING HERE.
			}
			else {
				return winWidth;
			}
		};

		return  {
			init: init,
			onScroll: onScroll,
			resize: resize,
			responsiveState: responsiveState
		}
	})();
	/* 
		UI Modifications 

		Various functions which operate on elements to achieve visual
		effects that are impossible to create with CSS alone.
	*/

	var uiMod = (function() {

		var setFilterHeadlineWidth = function() {
			// 1. Gather widths
			var navWidth = $('.filter ul').outerWidth();
			// console.log(navWidth);
			var containerWidth = $('.filter > div ').outerWidth();
			
			// 2. Determine new width for headline based on total div width - ul width
			var newHeadlineWidth = containerWidth - navWidth - 4; // 4 to accomodate for negative margin on li's
			// console.log(newHeadlineWidth);

			// 3. Set new weidth on headline
			$('.filter h6').css({"width":newHeadlineWidth});
		};

		// public
		return {
			setFilterHeadlineWidth: setFilterHeadlineWidth
		};
	})(); // var uiMod = (function() {



	/* 
		User interaction 

		Various functions which are called when the user intearcts
		with a piece of the site (eg. clicking, scrolling, etc)
	*/
	var userInput = (function() {

		var timelineCategoryClick = function(clicked) { // Matches the height of various elements to other elements in ways that are impossible with CSS alone
			// 1. Close/open select if we're displaying the select.
			if ($(window).width() <= 890) {
				$('.filter .hide').slideToggle();
			}

			// 2. Swap the Toggle link text to whatever the user clicked
			var clickedItemName = clicked.text();
			$('.toggle a').text(clickedItemName);

			// 3. Change the active nav
			if (clicked.closest('.toggle').length === 0) { // Unless the user clicked the toggle, that is.
				$('.filter a.active').removeClass('active');
				clicked.addClass('active');
			}

			// 4. Isotope this biznatch.

		};

		// public
		return {
			timelineCategoryClick: timelineCategoryClick
		};

	})(); // var uiMod = (function() {

	

	// public
	return {
		utility: utility,
		uiMod: uiMod,
		userInput: userInput
	};
})(jQuery); // var cs = (function() {