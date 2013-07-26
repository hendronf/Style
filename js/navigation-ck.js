/**
 * navigation.js
 *
 * Handles toggling the sub-menus
 */
 // (function(){function e(e){this.$el=$(e);this.subMenus=this.$el.find(".menu-item .nav-sub-menu");this.subMenus.addClass("is-hidden");this.hookEvents()}e.prototype={hookEvents:function(){this.$el.on("click",this.handleMenuClick)},handleMenuClick:function(e){var t=$(e.target).closest("li"),n=t.find(".nav-sub-menu").first();n.toggleClass("is-hidden");console.log(t);return!1}};new e(".nav-menu")})();