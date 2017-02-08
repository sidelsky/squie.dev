/* global require */
/* global window */
/* global site_data */
/* jshint -W097 */

//var vue = require('vue');

"use strict";
//Slick Slider
var mixitup = require('mixitup');

(function() {

    //console.log(document);
    var containerEl = document.querySelector('[data-portfolio-items]');

    var mixer = mixitup(containerEl, {
        animation : {
            effects: 'fade translateZ(-100px) stagger(30ms) scale(0.10)'
        },
        load : {
            filter : 'none'
        }
    });


    containerEl.classList.add('mixitup-ready');

    mixer.show()
        .then(function() {
            // Remove the stagger effect for any subsequent operations

            mixer.configure({
                animation: {
                    effects: 'fade translateZ(-100px) stagger(30ms) scale(0.10)'
                }
            });
        });

}());
