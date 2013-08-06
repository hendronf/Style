/**
 * navigation.js
 *
 * Handles toggling the sub-menus
 */
(function() {
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

            // if el has a parent .nav-sub-menu, this el is already part of a submenu
            // and we don't continue
            if ( $el.parent('.nav-sub-menu').length ) {
                return true;
            }

			subMenu.toggleClass('is-hidden');
            $el.toggleClass('submenu-open');

			console.log($el);
			return false;
		}
	}

	new initializeMenu('.nav-menu');
})();
