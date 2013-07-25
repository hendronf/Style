/**
 * navigation.js
 *
 * Handles toggling the sub-menus
 */
( function() {
	function initializeMenu(el) {
		this.$el = $(el);
		this.subMenus = this.$el.find('.menu-item .nav-sub-menu');

		this.subMenus.addClass('is-hidden');

		this.hookEvents();
	};

	initializeMenu.prototype = {
		hookEvents: function() {
			this.$el.on('click', this.handleMenuClick);
		},

		handleMenuClick: function(e) {
			var $el = $(e.target).closest('li'),
				subMenu = $el.find('.nav-sub-menu').first();

			subMenu.toggleClass('is-hidden');
			console.log($el);
			return false;
		}
	}



	new initializeMenu('.nav-menu');
} )();