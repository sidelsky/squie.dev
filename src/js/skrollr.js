/* global require */
/* global window */
/* global site_data */
/* jshint -W097 */

"use strict";
var $ = require('jquery');

/*
  EXAMPLE FILE TO DEMONSTRATE BROWSERIFY

  How to use a library that has support with browserify
  -------------------------
  • Ensure browser-sync isn't running
  • Use bower to install your library (with a --save). E.g. bower install skroll --save
  • Open up package.json and reference the (preferably) unminified source of the library. There are two examples there already
  • See below for an example of how to use the script (skrollr)
  • Start up browser-sync

  How to use a library that does not support with browserify
  -------------------------
  • I've installed the helpful 'browserify-shim' to take care of these sneaky scripts
  • Do everything as above, however, add your script in the 'browserify-shim' object in package.json (skrollr example already in there)
*/


//Our shimmed skrollr script
var skrollr = require('skrollr');
//Initialise skrollr
var s = skrollr.init();
