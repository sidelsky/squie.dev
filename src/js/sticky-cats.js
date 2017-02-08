/* global require */
/* global window */
/* global site_data */
/* jshint -W097 */

var cssClasses = require('./config').cssClasses;
var waypoints = require('waypoints');
var waypoints = require('dynamics');

(function() {

    var isFixed = cssClasses.isFixed,
        nav_container = $('[data-tax-filter]'),
        nav = $('[data-tax-filter-inner]'),
        bottom_spacing = 0,
        waypoint_offset = 0,
        time = 500,
        items = $('[data-tax-filter-inner]').find('button');

    //console.log(items);

    nav_container.waypoint({

        handler: function(direction) {

            if (direction == 'down') {

                //console.log('Going Down');
                // Navigation container height is dynamic
                nav_container.css({
                    'height': ''
                });

                nav.stop().addClass(isFixed).css('bottom', -nav.outerHeight()).animate({
                    'bottom': bottom_spacing
                }, time);

                animateIn();

            } else {

                //console.log('Going Up');
                // Navigation container height is dynamic
                nav_container.css({
                    'height': ''
                });

                nav.stop().removeClass(isFixed).css('bottom', nav.outerHeight() + waypoint_offset).animate({
                    'bottom': ''
                }, time);

            }

        },

        offset: '100%'

    });


    // Animate items in
    function animateIn(elem) {
        var items = $('[data-tax-filter-inner]').find('button');

        // Animate each line individually
        // Animate each line individually
        for (var i = 0; i < items.length; i++) {

            var item = items[i];

            // Define initial properties
            dynamics.css(item, {
                opacity: 1,
                translateY: 100
            });

            // Animate to final properties
            dynamics.animate(item, {
                opacity: 1,
                translateY: 0
            }, {
                type: dynamics.spring,
                frequency: 300,
                friction: 1000,
                duration: 500,
                delay: 10 + i * 40
            });

        }


    }


}());
