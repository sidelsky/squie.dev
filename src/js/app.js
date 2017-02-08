/* global require */
/* global window */
/* global site_data */
/* jshint -W097 */

"use strict";
var $ = require('jquery');

/*------------------------------------*\
	Hero title animation
\*------------------------------------*/
var $hero = $('[data-hero]');

    if ($hero.length) {
        var Hero = require('./hero-title');
        $hero.each(function(i, elem) {
          new Hero($(elem));
        });
    }


//Require our modules
/*------------------------------------*\
	portfolio
\*------------------------------------*/
var $portfolio = $('[data-portfolio]');

    if ($portfolio.length) {
        var Portfolio = require('./magic-door');
        $portfolio.each(function(i, elem) {
          new Portfolio($(elem));
        });
    }

/*------------------------------------*\
	Scroll to portfolio
\*------------------------------------*/
require('./scroll-to-portfolio.js');

/*------------------------------------*\
	Sticky cats nav
\*------------------------------------*/
require('./sticky-cats.js');

/*------------------------------------*\
	Background check
\*------------------------------------*/
//require('./backgroundcheck');

/*------------------------------------*\
	Sticky logo
\*------------------------------------*/
//require('./stickyLogo');

/*------------------------------------*\
	In view
\*------------------------------------*/
//require('./inview');

/*------------------------------------*\
	About info
\*------------------------------------*/
require('./cats-filter');


//TO GET THEME PATH use site_data.themePath
