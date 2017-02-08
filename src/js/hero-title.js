var cssClasses = require('./config').cssClasses;

var Hero = function Hero($elem) {

    this.$elem = $elem;
    this.$word = $('.inro-ani', this.$elem);
    this.$spinloader = $('[data-spin-loader]', this.$elem);
    this._attachHandlers();

};




// $(window).on('load', function(){
//
//     var $spinloader = $('.hero').find('[data-spin-loader]'),
//         time = 1000;
//
//     //this._attachHandlers();
//
//     $spinloader.css({
//         'display': 'block'
//     });
//
//     //console.log($spinloader);
//     $spinloader.fadeOut(time, function($elem){
//         this._attachHandlers();
//     });
//     //this._attachHandlers();
// });


/*  Attach handler event
 -----------------------------------*/
Hero.prototype._attachHandlers = function($elem) {

    var activeClass = cssClasses.animate,
        delayTime = 100,
        count = 0,
        time = 1000;

    var _this = this;

    // Window load
    $(window).on('load', function() {

        _this.$spinloader.fadeOut(time, function(){

            _this.$word.each(function() {

                var $item = $(this);

                $("body").queue(function(next) {

                    setTimeout(function($elem){
                        $item.addClass('animate');
                        //console.log(count);
                    }, 0);

                    next();

                }).delay(delayTime);

            });

        });


    });


};

// Hero.prototype._showIt = function() {
//   var n = div.queue( "fx" );
//   $( "span" ).text( n.length );
//   setTimeout( showIt, 100 );
// };




/*  Returns a constructor
 -----------------------------------*/
module.exports = Hero;
