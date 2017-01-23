/* global require */
/* global window */
/* global site_data */
/* jshint -W097 */
var vue = require('vue');
var $ = require('jquery');

$(document).ready(function() {



    var app = new Vue({
        el: '#app',
        data: {
            //show: true,
            message: 'Hello Vue.js!'
        }

    });

    console.log('Cats');

});
