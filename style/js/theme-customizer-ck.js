/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */(function(e){wp.customize("blogname",function(t){t.bind(function(t){e(".site-title a").html(t)})});wp.customize("blogdescription",function(t){t.bind(function(t){e(".site-description").html(t)})});wp.customize("background_color",function(t){t.bind(function(t){"#ffffff"==t||"#fff"==t?e("body").addClass("custom-background-white"):""==t?e("body").addClass("custom-background-empty"):e("body").removeClass("custom-background-empty custom-background-white")})})})(jQuery);