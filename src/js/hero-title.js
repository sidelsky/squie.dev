var cssClasses = require('./config').cssClasses;

var Title = function Title($elem) {

    this.$elem = $elem;
    this.$word = $('.inro-ani', this.$elem);

    this._attachHandlers();

};


/*  Attach handler event
 -----------------------------------*/
Title.prototype._attachHandlers = function($elem) {

    var activeClass = cssClasses.animate,
        delayTime = 100,
        count = 0;

    _this = this;

    _this.$word.each(function() {

        var $item = $(this);

        $("body").queue(function(next) {

            //count++;

            setTimeout(function($elem){
                $item.addClass('animate');
                //console.log(count);
            }, 100);

            next();

        }).delay(delayTime);

    });

};

// Title.prototype._showIt = function() {
//   var n = div.queue( "fx" );
//   $( "span" ).text( n.length );
//   setTimeout( showIt, 100 );
// };




/*  Returns a constructor
 -----------------------------------*/
module.exports = Title;
