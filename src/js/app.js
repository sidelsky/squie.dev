/* global require */
/* global window */
/* global site_data */
/* jshint -W097 */

"use strict";
var $ = require('jquery');

/*------------------------------------*\
	Full page
\*------------------------------------*/
require('./fullpage');

/*------------------------------------*\
	Hero title animation
\*------------------------------------*/
var $title = $('[data-hero-title]');

    if ($title.length) {
        var Title = require('./hero-title');
        $title.each(function(i, elem) {
          new Title($(elem));
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
	Background check
\*------------------------------------*/
require('./backgroundcheck');

/*------------------------------------*\
	Sticky logo
\*------------------------------------*/
require('./stickyLogo');

/*------------------------------------*\
	In view
\*------------------------------------*/
require('./inview');


/*------------------------------------*\
	Skrollr
\*------------------------------------*/
//require('./skrollr');


//TO GET THEME PATH use site_data.themePath
